<?php
namespace Pagination\Lib;

use Countable;
use Traversable;

interface PaginatorInterface extends Countable, Traversable
{
    public function getItems();
    
    public function getCurrentPageNumber(): int;
    
    public function getNumberOfPages(): int;
    
    public function getTotal(): int;
    
    public function getTotalOnCurrentPage(): int;
    
    public function getTotalPerPage(): int;
}