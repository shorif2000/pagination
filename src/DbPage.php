<?php
namespace Pagination;

use Pagination\Lib\PaginatorInterface;
use Pagination\Lib\Collection;


class DbPage extends Paginator
{
    private $pdo;
    private $table;
    
    public function __construct($options = []) {
        $this->pdo = $options['pdo'];
        $this->table = $options['table'];
        $this->limit = $options['limit'] ?? 10;
    }
    
    public function paginate(int $page = 1): PaginatorInterface
    {
        if ($page <= 0 || $this->limit <= 0) {
            throw new \LogicException("Invalid parameters.");
        }
        $offset = ($page - 1) * $this->limit;      
        
        $statement = $this->pdo->prepare('select * from ' . $this->table . ' limit ' . $offset . ', ' . $this->limit);
        $result = $statement->execute();

        $this->items = [];
        while ($row = $result->fetch()) {
            $this->items[] = $row;
        }
        
        $items = new Collection($this->items, $offset, $this->limit);
        
        $this->setCurrentPageNumber($page);
        $this->setNumberOfPages((int) ceil($items->getCount() / $items->getLimit()));
        $this->setItems($items->getItems());
        $this->setTotal($items->getCount());
        $this->setTotalOnCurrentPage(count($items->getItems()));
        $this->setTotalPerPage($this->limit);
        
        return $this;
    }

    
}