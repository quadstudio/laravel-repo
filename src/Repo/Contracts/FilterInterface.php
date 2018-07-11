<?php

namespace QuadStudio\Repo\Contracts;

interface FilterInterface
{
    function apply($builder, RepositoryInterface $repository);
}