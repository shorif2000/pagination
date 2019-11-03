<?php
namespace Pagination\Lib;


interface PaginationInterface
{
    /**
     * Paginate a collection of items
     *
     * @param $collection
     * @param int $page
     * @param int $limit
     * @return PaginationInterface
     */
    public function paginate(int $page = 1): PaginatorInterface;
}