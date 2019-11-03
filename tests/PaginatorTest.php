<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\Paginator;

class PaginatorTest extends TestCase
{

    /** @var Paginator */
    protected $paginator;

    public function setUp(): void
    {
        $numItems = 100;
        $itemsPerPage = 10;
        $currentPage = 5;
        $options = [
            'numItems' => $numItems,
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $currentPage
        ];
        $this->paginator = new Paginator($options);
    }

    public function testArray()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 10);
        $options = [
            'data' => $input
        ];
        $pageNumber = 1;
        $pagination = (new Paginator($options))->paginate($pageNumber);
        
        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());        
    }
    
    
    public function testArrayPage2()
    {
        $itemsPerPage = 10;
        $input = range(0, 100);
        $input = array_slice($input, 0, 20);
        $options = [
            'data' => $input
        ];
        $pageNumber = 2;
        $pagination = (new Paginator($options))->paginate($pageNumber);

        $this->assertEquals($itemsPerPage, $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
    }
    
    public function testArrayPage2NotEqualToItemsPerPage()
    {
        
        $input = range(0, 100);
        $input = array_slice($input, 0, 15);
        $options = [
            'data' => $input
        ];
        $pageNumber = 2;
        $pagination = (new Paginator($options))->paginate($pageNumber);
        
        $this->assertEquals(count(array_slice($input, 10, 10)), $pagination->getTotalOnCurrentPage());
        $this->assertEquals($pageNumber, $pagination->getCurrentPageNumber());
        $this->assertEquals(count($input), $pagination->getTotal());
        $this->assertEqualsCanonicalizing(array_slice($input, 10, 10),$pagination->getItems());
    }
}