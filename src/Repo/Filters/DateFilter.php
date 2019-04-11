<?php

namespace QuadStudio\Repo\Filters;

use Illuminate\Support\Facades\DB;
use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Tag;

abstract class DateFilter extends FormFilter
{

    /**
     * @var string
     */
    protected $search = 'date';

    function apply($builder, RepositoryInterface $repository)
    {
        if ($this->canTrack() && $this->filled($this->search)) {
            $builder = $builder->where(DB::raw('DATE(' . $this->column() . ')'), $this->operator(), date('Y-m-d', strtotime($this->get($this->search))));
        }

        return $builder;
    }

    /**
     * @return string
     */
    abstract function column();

    protected function operator()
    {
        return '=';
    }

    /**
     * @return Tag
     */
    public function tag(): Tag
    {
        if (is_null($this->tag)) {
            $attributes = $this->attributes();
            if ($this->has($this->name()) && $this->get($this->name()) != "") {
                $attributes['value'] = $this->get($this->name());
            }
            if (mb_strlen($this->placeholder(), 'UTF-8') > 0) {
                $attributes['placeholder'] = $this->placeholder();
            }
            $this->tag = new Tag('text', [
                'attributes' => $attributes,
            ]);
        }

        return $this->tag;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->search;
    }

    /**
     * @return string
     */
    protected function placeholder()
    {
        return '';
    }

    /**
     * @return array
     */
    public function track()
    {
        return [
            $this->search,
        ];
    }

}