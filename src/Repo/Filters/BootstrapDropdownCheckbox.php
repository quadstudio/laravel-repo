<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

trait BootstrapDropdownCheckbox
{
    public function init()
    {
        $checkboxes = [];
        foreach ($this->options() as $key => $value) {
            $attributes = [
                'class' => 'custom-control-input',
                'name'  => 'filter[' . $this->name() . '][]',
                'value' => $key,
                'id'    => $this->identifier . '_' . $key
            ];
            if ($this->has($this->name()) && $this->filled($this->name()) && in_array($key, $this->get($this->name())) === true) {
                $attributes['checked'] = 'checked';
            }

            $checkboxes[] = new Tag('div', [
                'attributes' => [
                    'class'      => 'custom-control custom-checkbox mb-1 mx-md-2',
                    'data-value' => $key
                ],
                'content'    => [
                    new Tag('checkbox', [
                        'attributes' => $attributes
                    ]),
                    new Tag('label', [
                        'attributes' => [
                            'style' => '-webkit-box-align: start;align-items: flex-start;-webkit-box-pack: start;justify-content: flex-start;',
                            'class' => 'custom-control-label',
                            'for'   => $this->identifier . '_' . $key
                        ],
                        'content'    => $value
                    ])

                ]
            ]);
        }
        $this->components->put('div', new Tag('div', [
            'attributes' => ['class' => 'input-group mb-1 mr-1'],
            'content'    => [
                new Tag('div', [
                    'attributes' => ['class' => 'dropdown dropdown-checkboxes'],
                    'content'    => [
                        new Tag('button', [
                            'attributes' => ['class' => 'input-group-text btn btn-default btn-sm dropdown-toggle', 'data-toggle' => 'dropdown'],
                            'content'    => [
                                new Tag('span', [
                                    'attributes' => [],
                                    'content'    => $this->label()
                                ]),
                                new Tag('span', [
                                    'attributes' => ['class' => 'caret'],
                                    'content'    => ''
                                ]),
                                new Tag('div', [
                                    'attributes' => ['class' => 'dropdown-menu'],
                                    'content'    => $checkboxes
                                ])
                            ]
                        ])
                    ]
                ])
            ]
        ]));
    }
}