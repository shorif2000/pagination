<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\Pagination;

class DbPageTest extends TestCase
{

    public function testArray()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $options = [
            'data' => $input
        ];
        $pageNumber = 1;
        $pagination = (new Pagination($options))->paginate($pageNumber);
        
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());        
    }
    
    
}