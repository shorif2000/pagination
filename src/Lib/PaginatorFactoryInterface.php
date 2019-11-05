<?php
namespace Pagination\Lib;

interface PaginatorFactoryInterface
{
    public function createPaginator(int $page, int $pageSize): PaginatorInterface;
}