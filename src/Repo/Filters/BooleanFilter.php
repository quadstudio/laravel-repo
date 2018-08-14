<?php

namespace QuadStudio\Repo\Filters;


use Illuminate\Support\Facades\DB;
use QuadStudio\Repo\Contracts\RepositoryInterface;

abstract class BooleanFilter extends SelectFilter
{

    function apply($builder, RepositoryInterface $repository)
    {

        if ($this->canTrack() && $this->filled($this->name())) {
            $builder = $builder->where(DB::raw($this->column()), $this->get($this->name()));

        } else {
            $this->applyDefaults($builder, $repository);
        }

        return $builder;
    }

    /**
     * @return string
     */
    abstract function column(): string;

    private function applyDefaults($builder, RepositoryInterface $repository)
    {
        if (!empty($this->defaults())) {
            foreach ($this->defaults() as $value) {
                if ($value != "") {
                    $builder = $builder->where(DB::raw($this->column()), $value);
                }
            }
        }
    }

    /**
     * Options
     *
     * @return array
     */
    function options(): array
    {
        $options = [
            ''  => trans('repo::messages.select'),
            '0' => trans('repo::messages.no'),
            '1' => trans('repo::messages.yes'),
        ];

        return $options;
    }
}