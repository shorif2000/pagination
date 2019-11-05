<?php
namespace Pagination\Lib;


interface PaginatorInterface
{
    public function getItems();
    
    public function getCurrentPageNumber(): int;
    
    public function getNumberOfPages(): int;
    
    public function getTotal(): int;
    
    public function getTotalOnCurrentPage(): int;
    
    public function getTotalPerPage(): int;
}