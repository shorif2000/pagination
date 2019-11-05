<?php
namespace Pagination;

use Pagination\Lib\PageProviderInterface;
use Pagination\Lib\PaginatorFactoryInterface;
use Pagination\Lib\PaginatorInterface;


class PaginatorFactory implements PaginatorFactoryInterface
{
    /** @var PageProviderInterface */
    private $pageProvider;
    
    public function __construct(PageProviderInterface $pageProvider)
    {
        $this->pageProvider = $pageProvider;
    }
    
    public function createPaginator(int $page, int $pageSize): PaginatorInterface
    {
        $total = $this->pageProvider->getTotalCount();
        $offset = ($page - 1) * $pageSize;
        if ($offset >= $total) {
            $items = new \EmptyIterator();
        } else {
            $items = $this->pageProvider->getPage($offset, $pageSize);
        }
        return new Paginator($page, $pageSize, $items, $total);
    }
}