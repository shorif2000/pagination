<?php
namespace shorif2000\Tests;

use Pagination\Paginator;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{

    /** @var Paginator */
    protected $paginator;

    public function setUp()
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
        $input = ['alpha', 'beta', 'delta', 'gamma'];
        $options = [
            'data'=>   $input
        ];
        $pagination = (new Paginator($options))->paginate($pageNumber ?? 1);
        print_r($pagination);
    }
}