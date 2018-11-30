<?php
return [
    'optgroup' => [
        'attributes' => [
            'disabled',
            'label',
        ],
        'closed'     => true,
        'only'       => ['select'],
    ],
    'option'   => [
        'attributes' => [
            'defaultSelected',
            'disabled',
            'form',
            'index',
            'label',
            'selected',
            'text',
            'value',
        ],
        'closed'     => true,
        'only'       => ['select'],
    ],
    'select'   => [
        'attributes' => [
            'autofocus',
            'disabled',
            'form',
            'multiple',
            'name',
            'required',
            'size',
        ],
        'closed'     => true,
        'contains'   => ['option', 'optgroup']
    ],
    'textarea' => [
        'attributes' => [
            'autofocus',
            'cols',
            'dirname',
            'disabled',
            'form',
            'maxlength',
            'name',
            'placeholder',
            'readonly',
            'required',
            'rows',
            'wrap',
        ],
        'closed'     => true,
    ],
    // input
    'button'   => [
        'closed'     => true,
        'attributes' => [
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'name',
            'value',
        ],
    ],
    'checkbox' => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autofocus',
            'checked',
            'defaultChecked',
            'defaultValue',
            'disabled',
            'form',
            'indeterminate',
            'name',
            'required',
            'type' => 'checkbox',
            'value',
        ],
    ],
    'color'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'name',
            'type' => 'color',
            'value',
        ],
    ],
    'date'     => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'readonly',
            'required',
            'step',
            'type' => 'date',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
    'email'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'maxlength',
            'minlength',
            'multiple',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'type' => 'email',
            'value',
        ],
    ],
    'file'     => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'accept',
            'autofocus',
            'defaultValue',
            'disabled',
            'files',
            'form',
            'multiple',
            'name',
            'required',
            'type' => 'file',
            'value',
        ],
    ],
    'hidden'   => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'form',
            'name',
            'type' => 'hidden',
            'value',
        ],
    ],
    'image'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'alt',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'formAction',
            'formEnctype',
            'formMethod',
            'formNoValidate',
            'formTarget',
            'height',
            'name',
            'src',
            'value',
            'type' => 'image',
            'width',
        ],
    ],
    'month'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'readonly',
            'required',
            'step',
            'type' => 'month',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
    'number'   => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'placeholder',
            'readonly',
            'required',
            'step',
            'type' => 'number',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
    'password' => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'maxlength',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'type' => 'password',
            'value',
        ],
        'methods'    => [
            'select',
        ],
    ],
    'radio'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autofocus',
            'checked',
            'defaultchecked',
            'defaultValue',
            'disabled',
            'form',
            'name',
            'required',
            'type' => 'radio',
            'value',
        ],
    ],
    'range'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'step',
            'type' => 'range',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
    'reset'    => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'name',
            'type' => 'reset',
            'value',
        ],
    ],
    'search'   => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'maxlength',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'type' => 'search',
            'value',
        ],
    ],
    'submit'   => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'formAction',
            'formEnctype',
            'formMethod',
            'formNoValidate',
            'formTarget',
            'name',
            'type' => 'submit',
            'value',
        ],
    ],
    'text'     => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'maxlength',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'type' => 'text',
            'value',
        ],
    ],
    'time'     => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'readonly',
            'required',
            'step',
            'type' => 'time',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
    'url'      => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'maxlength',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'type' => 'url',
            'value',
        ],
    ],
    'week'     => [
        'tag'        => 'input',
        'closed'     => false,
        'attributes' => [
            'autocomplete',
            'autofocus',
            'defaultValue',
            'disabled',
            'form',
            'list',
            'max',
            'min',
            'name',
            'readonly',
            'required',
            'step',
            'type' => 'week',
            'value',
        ],
        'methods'    => [
            'stepDown',
            'stepUp',
        ],
    ],
//    'a'        => [
//        'attributes' => [
//            'download',
//            'href',
//            'hreflang',
//            'media',
//            'rel'    => [
//                'alternate',
//                'author',
//                'bookmark',
//                'external',
//                'help',
//                'license',
//                'next',
//                'nofollow',
//                'noreferrer',
//                'noopener',
//                'prev',
//                'search',
//                'tag',
//            ],
//            'target' => [
//                ['_blank', '_self', '_parent', '_top',]
//            ],
//            'type'
//        ],
//    ],
//    'caption'  => [
//        'only' => ['table']
//    ],
//    'col'      => [
//        'only' => ['colgroup']
//    ],
//    'colgroup' => [
//        'attributes' => ['span'],
//        'only'       => ['table']
//    ],
    'div' => [
        'closed'     => true,
        'attributes' => [],
    ],
//    'fieldset' => [
//        'contains' => [
//            'legend'
//        ]
//    ],
//    'form'     => [
//
//        'attributes' => [
//            'accept',
//            'accept-charset',
//            'action',
//            'autocomplete' => ['on', 'off'],
//            'enctype'      => [
//                'application/x-www-form-urlencoded',
//                'multipart/form-data',
//                'text/plain',
//            ],
//            'method'       => ['get', 'post'],
//            'name',
//            'novalidate',
//            'target'       => ['_blank', '_self', '_parent', '_top',],
//        ],
//        'contains'   => [
//            'input',
//            'textarea',
//            'button',
//            'select',
//            'option',
//            'optgroup',
//            'fieldset',
//            'label',
//        ],
//    ],
//    'img'      => [
//        'required'   => ['src', 'alt',],
//        'closed'     => false,
//        'attributes' => [
//            'align',
//            'alt',
//            'border',
//            'crossorigin',
//            'height',
//            'hspace',
//            'ismap',
//            'longdesc',
//            'sizes',
//            'src',
//            'srcset',
//            'usemap',
//            'vspace',
//            'width',
//        ]
//    ],
    'label'    => [
        'closed'     => true,
        'attributes' => ['for', 'form'],
    ],
//    'legend'   => [
//        'only' => ['fieldset']
//    ],
    'ul'       => [
        'closed'     => true,
        'attributes' => [],
        'contains' => [
            'li'
        ],
    ],
    'li'       => [
        'closed'     => true,
        'attributes' => [
            'value'
        ],
        'only' => ['ol', 'ul']
    ],
//    'link'     => [
//        '_children' => [
//            'favicon' => [
//                'type'      => 'image/x-icon',
//                'rel'       => 'shortcut icon',
//                '_required' => [
//                    'href'
//                ]
//            ],
//            'style'   => [
//                'type'      => 'text/css',
//                'rel'       => 'stylesheet',
//                '_required' => [
//                    'href'
//                ],
//
//            ],
//        ]
//    ],
//    'meta'     => [
//        'attributes' => [
//            'charset',
//            'content',
//            'http-equiv' => [
//                'content-type',
//                'default-style',
//                'refresh',
//            ],
//            'name'       => [
//                'application-name',
//                'author',
//                'description',
//                'generator',
//                'keywords',
//                'viewport',
//            ]
//        ]
//    ],
//    'script'   => [
//        'type' => 'text/javascript',
//    ],
    'span'   => [
        'closed'     => true,
        'attributes' => [],
    ],
//    'table'    => [
//        'contains' => [
//            'thead',
//            'tbody',
//            'tfoot',
//            'colgroup',
//            'col',
//            'caption',
//        ],
//    ],
//    'tbody'    => [
//        'only'     => ['table'],
//        'contains' => ['tr']
//    ],
//    'tfoot'    => [
//        'only'     => ['table'],
//        'contains' => ['tr']
//    ],
//    'thead'    => [
//        'only'     => ['table'],
//        'contains' => ['tr']
//    ],
//    'title'    => [
//        'only'   => ['head'],
//        'events' => false,
//    ],
//    'td'       => [
//        'only'       => ['tr'],
//        'attributes' => [
//            'colspan',
//            'headers',
//            'rowspan',
//        ]
//    ],
//    'th'       => [
//        'only'       => ['tr'],
//        'attributes' => [
//            'abbr',
//            'colspan',
//            'headers',
//            'rowspan',
//            'scope' => ['col', 'colgroup', 'row', 'rowgroup'],
//            'sorted',
//        ]
//    ],
//    'tr'       => [
//        'only'     => ['thead', 'tfoot', 'tbody'],
//        'contains' => ['th', 'td']
//    ],


//    'ol'       => [
//        'contains' => [
//            'li'
//        ],
//    ],

];