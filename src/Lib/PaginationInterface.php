<?php
namespace Pagination\Lib;


interface PaginationInterface
{

    public function paginate(int $page = 1): PaginatorInterface;
}