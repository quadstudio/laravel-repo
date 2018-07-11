<?php

namespace QuadStudio\Repo\Contracts;


interface FormInterface
{
    function fields();

    function render();
}