<?php

namespace QuadStudio\Repo\Contracts;

interface Filterable
{
    /**
     * @param bool $status
     * @return $this
     */
    public function skipFilter($status = true);

    /**
     * @return mixed
     */
    public function getFilters();

    /**
     * @return mixed
     */
    function resetFilters();

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function applyFilter(FilterInterface $filter);

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function pushFilter(FilterInterface $filter);

    /**
     * @return $this
     */
    public function applyFilters();

    /**
     * @return array
     */
    function track(): array;

    /**
     * @param bool $status
     * @return mixed
     */
    function trackFilter($status = true);

    function toHtml();

}