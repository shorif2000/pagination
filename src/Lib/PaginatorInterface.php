<?php
namespace Pagination\Lib;

use Countable;
use Traversable;

interface PaginatorInterface extends Countable, Traversable
{

    public function getItems();

    public function setItems($items);

    public function getCurrentPageNumber(): int;

    public function setCurrentPageNumber($currentPageNumber);

    public function getNumberOfPages(): int;

    public function setNumberOfPages($numberOfPages);

    public function getTotal(): int;

    public function setTotal($total);

    public function getTotalOnCurrentPage(): int;

    public function getTotalPerPage(): int;

    public function getViewData(): array;
}