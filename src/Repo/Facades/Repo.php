<?php

namespace QuadStudio\Repo\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Repo extends BaseFacade
{


    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'repo';
    }

}
