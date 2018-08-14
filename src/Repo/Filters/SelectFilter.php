<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

abstract class SelectFilter extends FormFilter
{

    /**
     * @return Tag
     */
    public function tag(): Tag
    {
        if (is_null($this->tag)) {
            $content = [];

            foreach ($this->options() as $key => $value) {
                if (is_array($value)) {
                    $content[] = $this->getOptionGroup($key, $value);
                } else {
                    $content[] = $this->getOption($key, $value);
                }
            }


            $this->tag = new Tag('select', [
                'attributes' => $this->attributes(),
                'content'    => $content
            ]);
        }

        return $this->tag;

    }

    /**
     * @param $value
     * @param $content
     * @return Tag
     */
    protected function getOption($value, $content)
    {
        $attributes = [
            'value' => $value,
        ];
        if ($this->has($this->name()) && $this->filled($this->name()) && $this->get($this->name()) == $value) {
            $attributes[] = 'selected';
        } elseif(!empty($this->defaults()) && in_array($value, $this->defaults(), true)){
            $attributes[] = 'selected';
        }

        return new Tag('option', [
            'attributes' => $attributes,
            'content'    => $content
        ]);
    }

    /**
     * Options
     *
     * @return array
     */
    abstract function options(): array;

    /**
     * @param $label
     * @param $options
     * @return Tag
     */
    protected function getOptionGroup($label, $options)
    {
        $content = [];
        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $content[] = $this->getOptionGroup($key, $value);
            } else {
                $content[] = $this->getOption($key, $value);
            }
        }

        return new Tag('optgroup', ['attributes' => ['label' => $label], 'content' => $content]);
    }

}