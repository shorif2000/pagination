<?php
namespace Pagination;

use Pagination\Lib\AbstractCommon;
use Pagination\Lib\Collection;
use Pagination\Lib\ArrayData;
use Pagination\Lib\PaginatorInterface;

class Paginator extends AbstractCommon
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
        $items = new Collection($this->items, $offset, $this->limit);        
        if ($this->items instanceof \ArrayObject || is_array($this->items)) {
            $data = new ArrayData();
            $data->fetchItems($items);
        } else {
            throw new \RuntimeException("Data type not supported for pagination.");
        }
        $this->setCurrentPageNumber($page);
        $this->setNumberOfPages((int) ceil($items->getCount() / $items->getLimit()));
        $this->setItems($items->getItems());
        $this->setTotal($items->getCount());
        $this->setTotalOnCurrentPage(count($items->getItems()));
        $this->setTotalPerPage($this->limit);
        return $this;
    }
    
    public function getViewData(): array
    {
        return [
            'elements' => $this->getItems(),
            'currentPage' => $this->getCurrentPageNumber(),
            'pages' => $this->getNumberOfPages(),
            'totalElements' => $this->getTotal(),
            'totalElementsOnCurrentPage' => $this->getTotalOnCurrentPage(),
            'totalElementsPerPage' => $this->getTotalPerPage(),
        ];
    }
    
}