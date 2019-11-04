<?php
namespace Pagination;

use Pagination\Lib\DefaultPaginator;
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
        $pagination = new DefaultPaginator();
        
        $statement = $this->pdo->prepare('select * from ' . $this->table . ' limit ' . $offset . ', ' . $this->limit);
        $result = $statement->execute();

        $this->items = [];
        while ($row = $result->fetch()) {
            $this->items[] = $row;
        }
        
        $items = new Collection($this->items, $offset, $this->limit);
        
        $pagination->setCurrentPageNumber($page);
        $pagination->setNumberOfPages((int) ceil($items->getCount() / $items->getLimit()));
        $pagination->setItems($items->getItems());
        $pagination->setTotal($items->getCount());
        $pagination->setTotalOnCurrentPage(count($items->getItems()));
        $pagination->setTotalPerPage($this->limit);
        
        return $pagination;
    }

    
}