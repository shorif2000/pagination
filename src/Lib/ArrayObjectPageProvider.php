<?php 
namespace Pagination\Lib;

class ArrayObjectPageProvider implements PageProviderInterface
{
    private $items;
    
    public function __construct(\ArrayObject $items) {
        
        $this->items = $items;
    }
    
    public function getTotalCount(): int
    {
        return \count($this->items);
    }
    
    public function getPage(int $offset, int $limit): \Iterator
    {
        return new \ArrayIterator(\array_slice($this->items->getArrayCopy(), $offset, $limit));
    }
}