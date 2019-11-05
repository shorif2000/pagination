<?php
namespace Pagination\Lib;

abstract class AbstractCommon implements \Iterator, PaginatorInterface
{

    public function next()
    {
        return next($this->items);
    }

    public function valid()
    {
        return key($this->items) !== null;
    }

    public function current()
    {
        return current($this->items);
    }

    public function rewind()
    {
        return reset($this->items);
    }

    public function key()
    {
        return key($this->items);
    }
}
