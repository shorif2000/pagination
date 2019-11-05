<?php 
namespace Pagination\Lib;

class ArrayPageProvider implements PageProviderInterface
{
    private $collection;
    
    public function __construct(array $items) {
             
        $this->collection = new Collection($items);
    }
    
    public function getTotalCount(): int
    {
        return $this->collection->length();
    }
    
    public function getPage(int $offset, int $limit): \Iterator
    {
        return new \ArrayIterator(\array_slice($this->collection->getCollection(), $offset, $limit));
    }
}