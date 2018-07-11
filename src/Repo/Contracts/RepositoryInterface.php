<?php

namespace QuadStudio\Repo\Contracts;

interface RepositoryInterface
{
    function all($columns = array('*'));

    function paginate($perPage = null, $columns = array('*'), $pageName = 'page', $page = null);

    function create(array $data);

    function update(array $data, $id);

    function delete($id);

    function find($id, $columns = array('*'));

    function getTable();

}