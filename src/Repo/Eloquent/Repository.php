<?php

namespace QuadStudio\Repo\Eloquent;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Contracts\Filterable;
use Quadstudio\Repo\Exceptions\RepositoryException;
use QuadStudio\Repo\Contracts\FilterInterface;
use QuadStudio\Repo\Filters\FormFilter;


abstract class Repository implements RepositoryInterface, Filterable
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $filters;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var bool
     */
    protected $isTracked = false;

    /**
     * @var bool
     */
    protected $skipFilter = false;
    private $appliedFilters = [];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->resetFilters();
        $this->getModel();
        //$this->makePresenter();
        //$this->makeValidator();

        $this->boot();
    }

    /**
     * Reset all Filters
     *
     * @return $this
     */
    public function resetFilters()
    {
        $this->filters = new Collection();

        return $this;
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function getModel()
    {
        if (!$this->app->has($this->model())) {
            $this->app->bind($this->model());
            $model = $this->app->make($this->model());

            if (!$model instanceof Model) {
                $this->table = $model->getTable();
                throw new RepositoryException(trans('repo::exception.instance', ['class' => $this->model(), 'instance' => Model::class]));
            }
            $this->model = $model;
        }

        return $this->model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     *
     */
    public function boot()
    {
        //
    }

    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipFilter($status = true)
    {
        $this->skipFilter = $status;

        return $this;
    }

    /**
     * Skip Filters
     *
     * @param bool $status
     *
     * @return $this
     */
    public function trackFilter($status = true)
    {
        $this->isTracked = $status;

        return $this;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {

        $this->applyFilters();


        return $this->getModel()->get($columns);
    }

    public function toSql(){
        return $this->getModel()->toSql();
    }

    public function getBindings(){
        return $this->getModel()->getBindings();
    }

    public function orderBy(array $columns = []){
        if(!empty($columns)){

            foreach ($columns as $column_name => $direction){
                if(is_int($column_name)){
                    $column_name = $direction;
                    $direction = 'ASC';
                }
                $this->model = $this->getModel()->orderBy($column_name, $direction);
            }
        }
        return $this;
    }

    /**
     * Apply filters
     *
     * @return $this
     */
    public function applyFilters()
    {
        if ($this->skipFilter === false) {

            $this->pushTracked();

            foreach ($this->getFilters() as $filter) {
                $this->applyFilter($filter);
            }

        }

        //dd($this->getFilters());

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function pushTracked()
    {
        if ($this->isTracked === true) {
            foreach ($this->track() as $filterClass) {
                if (!($filter = $this->app->make($filterClass)) instanceof FilterInterface) {
                    throw new \Exception(trans('repo::exception.instance', ['class' => $filterClass, 'instance' => FilterInterface::class]));
                }
                $this->pushFilter($filter);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function track(): array
    {
        return [];
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function pushFilter(FilterInterface $filter)
    {
        $this->filters->push($filter);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function applyFilter(FilterInterface $filter)
    {
        $this->model = $filter->apply($this->model, $this);
        return $this;
    }

    /**
     * @param $offset
     * @param $limit
     * @return Collection
     */
    public function offset($offset, $limit, $columns = ['*'])
    {
        $this->applyFilters();

        return $this->getModel()
            ->select($columns)
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param $chunk
     * @param callable $callback
     * @return mixed
     */
    public function chunk($chunk, callable $callback)
    {
        $this->applyFilters();

        return $this->getModel()->chunk($chunk, $callback);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->applyFilters();
        //dump($this->getModel());
        //dump($this->getModel()->getBindings());

        return $this->getModel()->paginate($perPage, $columns, $pageName, $page)->appends(request()->except(['page', '_token']));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->getModel()->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->getModel()->where('id', $id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->getModel()->findOrFail($id, $columns);
    }

    public function toHtml()
    {

        foreach ($this->getFilters() as $filter) {

            if (in_array(get_class($filter), $this->track()) && $filter instanceof FormFilter) {
                $filter->render();
            }
        }
    }

    public function canDraw()
    {
        foreach ($this->getFilters() as $filter) {
            if (in_array(get_class($filter), $this->track()) && $filter instanceof FormFilter && $filter->canRender()) {
                return true;
            }
        }

        return false;
    }

}