<?php
namespace Pagination;

use Pagination\Lib\AbstractCommon;

class Paginator extends AbstractCommon
{

    private $pageNumber;

    private $itemsPerPage;

    private $items;

    private $total;

    public function __construct(int $pageNumber, int $itemsPerPage, \Iterator $pageItems, int $total)
    {
        if ($pageNumber < 1) {
            throw new \InvalidArgumentException();
        }
        if ($itemsPerPage < 1) {
            throw new \InvalidArgumentException();
        }
        $this->pageNumber = $pageNumber;
        $this->itemsPerPage = $itemsPerPage;
        $this->items = $pageItems;
        $this->total = $total;
    }

    public function getItems(): \Iterator
    {
        return $this->items;
    }

    public function getCurrentPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function getNumberOfPages(): int
    {
        return \ceil($this->getTotal() / $this->itemsPerPage);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getTotalOnCurrentPage(): int
    {
        if ($this->items instanceof \Countable) {
            return \count($this->items);
        }
        return \iterator_count($this->items);
    }

    public function getTotalPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function count()
    {}
}