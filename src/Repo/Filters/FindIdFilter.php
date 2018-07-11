<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filter;

final class FindIdFilter extends Filter
{

    protected $multiple = true;

    function apply($builder, RepositoryInterface $repository)
    {

        if ($this->canTrack()) {
            if ($this->multiple === true && is_array($this->get('id'))) {
                foreach ($this->get('id') as $key => $id) {
                    $builder = $builder->orWhere('id', $id);
                }
            } else {
                $builder = $builder->whereId($this->get('id'));
            }
        }

        return $builder;
    }

    public function track()
    {
        return [
            'id',
        ];
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
    }
}