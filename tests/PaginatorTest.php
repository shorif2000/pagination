<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\PaginatorFactory;
use Pagination\Lib\ArrayPageProvider;
use Pagination\Lib\ArrayObjectPageProvider;

class PaginatorTest extends TestCase
{

    public function testArray()
    {
        $pageNumber = 1;
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $pagination = (new PaginatorFactory(new ArrayPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
        
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());  
         
    }
    
    
    public function testArrayPage2()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 20);
        $pageNumber = 2;
        $pagination = (new PaginatorFactory(new ArrayPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);

        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
    }
    
    public function testArrayPage2NotEqualToItemsPerPage()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 15);
        $pageNumber = 2;
        $pagination = (new PaginatorFactory(new ArrayPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
        
        $this->assertEquals(count(array_slice($input, 10, 10)), $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
        $this->assertEqualsCanonicalizing(array_slice($input, 10, 10),$pagination->getItems());
    }
    
    public function testArrayObject()
    {
        $itemsPerPage = 10;        
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $input = new \ArrayObject($input);
        $pageNumber = 1;
        $pagination = (new PaginatorFactory(new ArrayObjectPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
        
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
    }
    
    
    public function testArrayObjectPage2()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = (object) array_slice($input, 0, 20);
        $input = new \ArrayObject($input);
        $pageNumber = 2;
        $pagination = (new PaginatorFactory(new ArrayObjectPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
        
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
    }
    
    public function testArrayObjectPage2NotEqualToItemsPerPage()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = (object) array_slice($input, 0, 15);
        $input = new \ArrayObject($input);
        $pageNumber = 2;
        $pagination = (new PaginatorFactory(new ArrayObjectPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
        
        $this->assertEquals(count(array_slice($input->getArrayCopy(), 10, 10)), $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals($input->count(), $pagination->getTotal());
        $this->assertEqualsCanonicalizing(array_slice($input->getArrayCopy(), 10, 10),$pagination->getItems()->getArrayCopy());
    }
}