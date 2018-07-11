<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

trait BootstrapCheckbox
{
    public function init()
    {
        $this->components->put('div', new Tag('div', [
            'attributes' => ['class' => 'custom-control custom-checkbox mb-1 mx-md-2'],
            'content'    => [
                $this->tag()->mergeAttribute('class', 'custom-control-input'),
                new Tag('label', [
                    'attributes' => ['class' => 'custom-control-label', 'for' => $this->identifier],
                    'content'    => $this->label() !== false ? $this->label() : ''
                ])

            ]
        ]));

    }
}