<?php
namespace Pagination;

use Pagination\Lib\DefaultPaginator;
use Pagination\Lib\Collection;
use Pagination\Lib\ArrayData;
use Pagination\Lib\PaginatorInterface;

class Paginator
{
    public $limit; 
    
    public function __construct($options = [])
    {
        $this->items = $options['data'];
        $this->limit = $options['limit'] ?? 10;
    }
    
    public function paginate(int $page = 1): PaginatorInterface
    {
        if ($page <= 0 || $this->limit <= 0) {
            throw new \LogicException("Invalid parameters.");
        }
        
        $offset = ($page - 1) * $this->limit;
        $pagination = new DefaultPaginator();
        $items = new Collection($this->items, $offset, $this->limit);
        if ($this->items instanceof \ArrayObject || is_array($this->items)) {
            $data = new ArrayData();
            $data->fetchItems($items);
        } else {
            throw new \RuntimeException("Data type not supported for pagination.");
        }
        $pagination->setCurrentPageNumber($page);
        $pagination->setNumberOfPages((int) ceil($items->getCount() / $items->getLimit()));
        $pagination->setItems($items->getItems());
        $pagination->setTotal($items->getCount());
        $pagination->setTotalOnCurrentPage(count($items->getItems()));
        $pagination->setTotalPerPage($this->limit);
        return $pagination;
    }
    
}