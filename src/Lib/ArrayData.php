<?php
namespace Pagination\Lib;
use ArrayObject;


class ArrayData implements DataInterface
{

    public function fetchItems(Collection &$items): void
    {
        if (is_array($items->getCollection())) {
            $items->setItems(array_slice(
                $items->getCollection(),
                $items->getOffset(),
                $items->getLimit()
            ));
            $items->setCount(count($items->getCollection()));
        } elseif ($items->getCollection() instanceof ArrayObject) {

            $collection = $items->getCollection();
            $items->setItems(new ArrayObject(array_slice(
                $collection->getArrayCopy(),
                $items->getOffset(),
                $items->getLimit()
            )));
            $items->setCount($collection->count());
        }
    }
}