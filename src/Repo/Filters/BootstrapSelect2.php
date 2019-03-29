<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

trait BootstrapSelect2
{
    public function init()
    {

        $this->components->put('label', new Tag('label', [
            'attributes' => ['class' => 'sr-only', 'for' => $this->identifier],
            'content'    => $this->label() !== false ? $this->label() : ''
        ]));

        $this->components->put('div', new Tag('div', [
            'attributes' => ['class' => 'input-group mb-1 mr-1'],
            'content'    => [
                new Tag('div', [
                    'attributes' => ['class' => 'input-group-prepend'],
                    'content'    => new Tag('span', [
                        'attributes' => ['class' => 'input-group-text'],
                        'content'    => $this->label() !== false ? $this->label() : ''
                    ])
                ]),
                $this->tag()->mergeAttribute('class', 'form-control select2')
            ]
        ]));

    }
}