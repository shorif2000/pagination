<?php
namespace Pagination\Lib;


class Collection
{
    protected $collection;
    protected $count = 0;
    protected $items = [];
    protected $limit;
    protected $offset;

    public function __construct($collection, $offset, $limit)
    {
        $this->collection = $collection;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }
}