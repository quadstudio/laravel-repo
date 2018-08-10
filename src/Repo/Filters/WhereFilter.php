<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use DB;

abstract class WhereFilter extends SelectFilter
{

    function apply($builder, RepositoryInterface $repository)
    {

        if ($this->canTrack() && !is_null($this->get($this->name()))) {
            if ($this->multiple === true && is_array($this->get($this->name()))) {
                foreach ($this->get($this->name()) as $key) {

                    $builder = $builder->orWhere(DB::raw($this->column()), $this->operator(), $key);

                }
            } else {
                $builder = $builder->where(DB::raw($this->column()), $this->operator(), $this->get($this->name()));
            }

        }

        return $builder;
    }

    protected function operator(){
        return '=';
    }

    /**
     * @return string
     */
    abstract function column(): string;



}