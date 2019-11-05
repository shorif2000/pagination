<?php
namespace Pagination\Lib;

use Pagination\Exception\KeyhasUseException;
use Pagination\Exception\KeyInvalidException;

class Collection
{
    private $items = [];

    public function __construct($collection)
    {
        $this->items = $collection;
    }
    
    public function getCollection()
    {
        return $this->items;
    }
    
    public function addItem($obj, $key = null)
    {
        if ($key == null) {
            $this->items[] = $obj;
        } else {
            if (isset($this->items[$key])) {
                throw new KeyhasUseException("Key $key already in use.");
            } else {
                $this->items[$key] = $obj;
            }
        }
    }

    public function deleteItem($key)
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function getItem($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function length(): int
    {
        return count($this->items);
    }

    public function keyExists($key): bool
    {
        return isset($this->items[$key]);
    }
}