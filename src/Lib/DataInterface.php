<?php
namespace Pagination\Lib;

interface DataInterface
{    
    public function fetchItems(Collection &$items): void;
}