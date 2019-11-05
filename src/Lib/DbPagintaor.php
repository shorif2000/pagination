<?php
namespace Pagination\Lib;

class DbPagintaor implements PageProviderInterface
{
    private $pdo;
    private $table;
    
    public function __construct(\PDO $pdo, string $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }
    
    public function getTotalCount(): int
    {
        $statement = $this->pdo->prepare('select count(*) from ' . $this->table);
        return $statement->fetchColumn();
    }
    
    public function getPage(int $offset, int $limit): \Iterator
    {
        $statement = $this->pdo->prepare('select * from ' . $this->table . ' limit ' . $offset . ',' . $limit);
        $result = $statement->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            yield $i++ => $row;
        }
    }
    
}