<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;

abstract class HasFilter extends SelectFilter
{

    function apply($builder, RepositoryInterface $repository)
    {

        if ($this->canTrack() && !is_null($this->get($this->name()))) {
            if ($this->has($this->name()) && $this->filled($this->name())) {
                if ($this->get($this->name()) == 0) {
                    $builder = $builder->doesntHave($this->relation());
                } else {
                    $builder = $builder->has($this->relation());
                }

            }

        }

        return $builder;
    }

    /**
     * @return string
     */
    abstract function relation(): string;

    /**
     * Get the evaluated contents of the object.
     *
     * @return array
     */
    public function options(): array
    {
        return [
            ''  => trans('repo::messages.select'),
            '1' => trans('repo::messages.yes'),
            '0' => trans('repo::messages.no'),
        ];
    }

    public function defaults(): array
    {
        return [''];
    }

}