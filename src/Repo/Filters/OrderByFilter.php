<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filter;

class OrderByFilter extends Filter
{

    protected $orderBy = 'sort_field';
    protected $sortBy = 'sort_order';

    protected $table;

    function apply($builder, RepositoryInterface $repository)
    {
        $builder = $this->before($builder, $repository);

        $this->table = $repository->getTable();

        if ($this->canTrack()) {

            if ($this->multiple === true && is_array($this->get($this->orderBy)) && is_array($this->get($this->sortBy))) {
                foreach ($this->get($this->orderBy) as $key => $field) {
                    $builder = $builder->orderBy($field, $this->get($this->sortBy . '.' . $key));
                }
            } else {
                $builder = $builder->orderBy($this->get($this->orderBy), $this->get($this->sortBy));
            }

        } elseif (!empty($this->defaults())) {

            foreach ($this->defaults() as $key => $value) {
                if ($this->multiple === true && is_array($value)) {
                    foreach ($value as $sort_field => $sort_order) {
                        $builder = $builder->orderBy($sort_field, $sort_order);
                    }
                } else {
                    $builder = $builder->orderBy($key, $value);
                }
            }

        }

        $builder = $this->after($builder, $repository);

        return $builder;
    }



    public function track()
    {
        return [
            $this->orderBy,
            $this->sortBy,
        ];
    }

}