<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\Pagination;

class DbPagintaorTest extends TestCase
{

    public function testArray()
    {
        $this->markAsIncomplete();
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $options = [
            'pdo' => '',
            'table'=>'country'
        ];
        $pageNumber = 1;
        $pagination = Pagination::factory($options, 'db')->paginate(1);
     
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());        
    }
    
    
}