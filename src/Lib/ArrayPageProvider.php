<?php 
namespace Pagination\Lib;

class ArrayPageProvider implements PageProviderInterface
{
    private $items;
    private $collection;
    
    public function __construct(array $items) {
             
        $this->collection = new Collection($items);
    }
    
    public function getTotalCount(): int
    {
        return \count($this->items);
    }
    
    public function getPage(int $offset, int $limit): \Iterator
    {
        return new \ArrayIterator(\array_slice($this->collection->getCollection(), $offset, $limit));
    }
}