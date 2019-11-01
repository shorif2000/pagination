<?php
namespace shorif2000\Tests;

use PHPUnit\Framework\TestCase;
use Pagination\Paginator;

class PaginatorTest extends TestCase
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
        $input = [
            'alpha',
            'beta',
            'delta',
            'gamma'
        ];
        $options = [
            'data' => $input
        ];
        $pagination = (new Paginator($options))->paginate($pageNumber ?? 1);
        print_r($pagination);
    }
}