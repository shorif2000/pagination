<?php
namespace Pagination\Lib;


abstract class AbstractCommon implements \Iterator, PaginatorInterface
{

    protected $currentPageNumber;

    protected $items = [];
 
    protected $numberOfPages;

    protected $total;

    protected $totalPerPage;
 
    protected $totalOnCurrentPage;

    public function count()
    {
        return count($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid()
    {
        return key($this->items) !== null;
    }

    public function rewind()
    {
        return reset($this->items);
    }
 
    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function getCurrentPageNumber(): int
    {
        return $this->currentPageNumber;
    }

    public function setCurrentPageNumber($currentPageNumber)
    {
        $this->currentPageNumber = $currentPageNumber;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }

    public function setNumberOfPages($numberOfPages)
    {
        $this->numberOfPages = $numberOfPages;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotalOnCurrentPage(): int
    {
        return $this->totalOnCurrentPage;
    }

    public function setTotalOnCurrentPage($totalOnCurrentPage)
    {
        $this->totalOnCurrentPage = $totalOnCurrentPage;
    }
  
    public function getTotalPerPage(): int
    {
        return $this->totalPerPage;
    }

    public function setTotalPerPage($totalPerPage)
    {
        $this->totalPerPage = $totalPerPage;
    }
}