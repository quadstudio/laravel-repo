<?php

namespace QuadStudio\Repo;

use Illuminate\Support\Collection;
use QuadStudio\Repo\Contracts\FilterInterface;
use QuadStudio\Repo\Contracts\RepositoryInterface;

abstract class Filter implements FilterInterface
{
    /**
     * @var
     */
    protected $tag;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $query;

    /**
     * Indicates that this filter must be tracked
     *
     * @var bool
     */
    protected $tracked = true;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var bool
     */
    protected $divide = false;

    /**
     * Indicates that all tracked queries must be filled in
     *
     * @var bool
     */
    protected $filled = true;

    /**
     * Use multiple name filter
     *
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var bool
     */
    protected $store = false;

    /**
     * @var Collection
     */
    protected $params;


    /**
     * Filter constructor.
     * @param array|null $params
     */
    public function __construct(array $params = [])
    {
        $this->query = config('repo.query', 'filter');
        $this->params = collect($params);
    }

    /**
     * @return bool
     */
    public function canTrack()
    {
        return $this->tracked === true && $this->hasKeys() && ($this->filled === false || $this->hasValues());
    }

    protected function before($builder, RepositoryInterface $repository)
    {
        return $builder;
    }

    protected function after($builder, RepositoryInterface $repository)
    {
        return $builder;
    }

    /**
     * @return bool
     */
    public function hasKeys()
    {
        return is_array(request()->input($this->query)) && empty(array_diff($this->track(), array_keys(request()->input($this->query, []))));
    }

    /**
     * Возвращает список параметров строки запроса,
     * которые должны быть отслежены фильтром
     *
     * @return array
     */
    public function track()
    {
        return [];
    }

    /**
     * Проверяет, заполнены ли в строке запроса
     * все значения параметров для отлеживаемых фильтров
     *
     * @return bool
     */
    protected function hasValues()
    {

        foreach ($this->track() as $tracked) {

            if (!$this->has($tracked)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Проверяет, заполнено ли значение для параметрв запроса $key
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return request()->has($this->query . '.' . $key);
    }

    /**
     * Возвращает значения по умолчанию для параметров фильтра
     *
     * @return array
     */
    public function defaults(): array
    {
        return [];
    }

    /**
     * Получает значение параметра из строки запроса
     *
     * @param $key
     * @return array|null|string
     */
    public function get($key)
    {
        return request()->input($this->query . '.' . $key);
    }

}