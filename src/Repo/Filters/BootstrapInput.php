<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Tag;

trait BootstrapInput
{
    public function init()
    {
        $this->components->put('label', new Tag('label', [
            'attributes' => ['class' => 'sr-only', 'for' => $this->identifier],
            'content'    => $this->label() !== false ? $this->label() : ''
        ]));
        $this->components->put($this->identifier, $this->tag()
            ->mergeAttribute('class', 'form-control mb-1 mr-1')
            ->putAttribute('placeholder', $this->label() !== false ? $this->label() : '')
        );

    }
}