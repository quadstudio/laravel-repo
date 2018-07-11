<?php

namespace QuadStudio\Repo\Filters;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use QuadStudio\Repo\Filter;
use QuadStudio\Repo\Tag;

abstract class FormFilter extends Filter implements Renderable
{

    /**
     * Render filter
     *
     * @var bool
     */
    protected $render = false;
    /**
     * @var string
     */
    protected $identifier;
    /**
     * @var Collection
     */
    protected $components;

    /**
     * @var Tag|string
     */
    protected $label;

    /**
     * FormFilter constructor.
     * @param array $params
     */
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->identifier = snake_case(last(explode('\\', get_class($this))));
        $this->components = collect([]);
    }

    final public function render()
    {

        $this->init();

        if ($this->canRender()) {
            foreach ($this->components as $component) {
                echo $component;
            }
        }
    }

    protected function init()
    {
        $this->components->put($this->identifier(), $this->tag());
    }

    protected function identifier()
    {
        return $this->identifier;
    }

    abstract function tag(): Tag;

    /**
     * @return bool
     */
    public function canRender()
    {
        return $this->render === true;
    }

    protected function label()
    {
        return false;
    }


    protected function attributes()
    {
        return collect([
            'id'   => $this->identifier,
            'name' => $this->query . '[' . $this->name() . ']',
        ]);
    }

    /**
     * @return string
     */
    abstract function name(): string;

}