<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

trait BootstrapTempusDominusDate
{
    public function init()
    {
        $this->components->put('label', new Tag('label', [
            'attributes' => ['class' => 'sr-only', 'for' => $this->identifier],
            'content'    => $this->label() !== false ? $this->label() : ''
        ]));
        $this->components->put('div', new Tag('div', [
            'attributes' => [
                'id'                => 'datetimepicker_' . $this->identifier,
                'class'             => 'input-group date datetimepicker mb-1 mr-1',
                'data-target-input' => 'nearest'

            ],
            'content'    => [
                new Tag('div', [
                    'attributes' => ['class' => 'input-group-prepend'],
                    'content'    => new Tag('div', [
                        'attributes' => [
                            'class' => 'input-group-text'
                        ],
                        'content'    => $this->label() !== false ? $this->label() : '<i class="fa fa-calendar"></i>'
                    ])
                ]),
                $this->tag()
                    ->mergeAttribute('class', ' form-control')
                    ->mergeAttribute('class', ' datetimepicker-input')
                    ->mergeAttribute('data-toggle', 'datetimepicker')
                    ->mergeAttribute('data-target', '#datetimepicker_' . $this->identifier)
            ],

        ]));
    }
}