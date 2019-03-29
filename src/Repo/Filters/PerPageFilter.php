<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;

abstract class PerPageFilter extends SelectFilter
{

    use BootstrapSelect;

    protected $render = true;

    public function apply($builder, RepositoryInterface $repository)
    {
        return $builder;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return 'per_page';
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return array
     */
    public function options(): array
    {
        return config('repo.per_page.range.r10', [10 => 10]);
    }


    public function defaults(): array
    {
        return [config('repo.per_page.default', 10)];
    }

    public function label()
    {
        return trans('site::messages.per_page');
    }

}