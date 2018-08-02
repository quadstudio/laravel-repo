<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;

abstract class SortFilter extends SelectFilter
{

    protected $table;

    function apply($builder, RepositoryInterface $repository)
    {

        $this->table = $repository->getTable();

        if ($this->canTrack()) {
            if ($this->multiple === true) {
                throw new \Exception('method not be complete');
//                foreach ($this->get($this->orderBy) as $key => $field) {
//                    $builder = $builder->orderBy($field, $this->get($this->sortBy . '.' . $key));
//                }
            } else {

                if (($params = $this->getSortParams()) !== false) {
                    $builder = $builder->orderBy($params['field'], $params['dir']);
                } else {
                    $this->applyDefaults($builder, $repository);
                }
            }


        } else {
            $this->applyDefaults($builder, $repository);

        }

        return $builder;
    }

    private function getSortParams()
    {
        $param = $this->get($this->name());

        if (!is_null($param)) {
            if (strpos($param, config('site.delimiter')) !== false) {
                list($field, $dir) = explode(config('site.delimiter'), $param);
                $dir = in_array($dir, ['asc', 'desc']) ? $dir : 'asc';
                if (key_exists($field, ($columns = $this->columns()))) {
                    return [
                        'field' => $columns[$field],
                        'dir'   => $dir
                    ];
                }
            }
        }


        return false;
    }

    /**
     * @return array
     */
    abstract protected function columns(): array;

    private function applyDefaults($builder, RepositoryInterface $repository)
    {
        if (!empty($this->defaults())) {
            foreach ($this->defaults() as $key => $value) {
                if ($this->multiple === true && is_array($value)) {
                    throw new \Exception('method not be complete');
//                    foreach ($value as $sort_field => $sort_order) {
//                        $builder = $builder->orderBy($sort_field, $sort_order);
//                    }
                } else {
                    $builder = $builder->orderBy($key, $value);
                }
            }

        }
    }

    public function track()
    {
        return [$this->name()];
    }

}