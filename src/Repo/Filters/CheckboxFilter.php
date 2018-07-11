<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

abstract class CheckboxFilter extends FormFilter
{

    /**
     * @return Tag
     */
    public function tag(): Tag
    {
        if (is_null($this->tag)) {

            $attributes = $this->attributes();
            if (mb_strlen($this->value(), 'UTF-8') > 0) {
                $attributes['value'] = $this->value();
            }

            if ($this->has($this->name())) {
                $attributes[] = 'checked';
            }


            $this->tag = new Tag('checkbox', [
                'attributes' => $attributes
            ]);
        }

        return $this->tag;

    }

    /**
     * Options
     *
     * @return string
     */
    abstract function value(): string;

}