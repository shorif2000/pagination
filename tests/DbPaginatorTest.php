<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\PaginatorFactory;
use Pagination\Lib\DbPagintaor;

class DbPagintaorTest extends TestCase
{

    public function testArray()
    {
        $this->markTestIncomplete('mysql mock not complete');
        $pageNumber = 1;
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $pdo = '';
        $table = 'country';
        $pagination = (new PaginatorFactory(new DbPagintaor($pdo, $table)))->createPaginator($pageNumber, $itemsPerPage);
     
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());        
    }
    
    
}