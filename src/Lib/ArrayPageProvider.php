<?php 
namespace Pagination\Lib;

class ArrayPageProvider implements PageProviderInterface
{
    private $items;
    
    public function __construct(array $items) {
        
        $this->items = $items;
    }
    
    public function getTotalCount(): int
    {
        return \count($this->items);
    }
    
    public function getPage(int $offset, int $limit): \Iterator
    {
        return new \ArrayIterator(\array_slice($this->items, $offset, $limit));
    }
}