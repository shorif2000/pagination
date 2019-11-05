# pagination demo

Creates a pagination control structure for a list of items. Support traversable list or collection and produce a data structure that defines a set of pagination parameters. (`array/ArrayObject` and possible a database connection asusming mysql).

## Prerequisites

  - Composer 
  - PhP 7.1

## Installing

```bash
composer require shorif2000/pagination
```

### Usage

#### Array 

```php
use Pagination\PaginatorFactory;
use Pagination\Lib\ArrayPageProvider;

...

$pageNumber = 1;
$itemsPerPage = 10;
$input = range(0, 100);
$input = array_slice($input, 0, 10);
$pagination = (new PaginatorFactory(new ArrayPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
```

#### ArrayObject

```php
use Pagination\PaginatorFactory;
use Pagination\Lib\ArrayObjectPageProvider;

...

$itemsPerPage = 10;        
$input = range(0, 100);
$input = array_slice($input, 0, 10);
$input = new \ArrayObject($input);
$pageNumber = 1;
$pagination = (new PaginatorFactory(new ArrayObjectPageProvider($input)))->createPaginator($pageNumber, $itemsPerPage);
```

You can call the following functions to get data

```php
    public function getItems();
    
    public function getCurrentPageNumber(): int;
    
    public function getNumberOfPages(): int;
    
    public function getTotal(): int;
    
    public function getTotalOnCurrentPage(): int;
    
    public function getTotalPerPage(): int;
```

#### Experimental

For database support.

```php

use Pagination\PaginatorFactory;
use Pagination\Lib\DbPagintaor;

...

$pageNumber = 1;
$itemsPerPage = 10;
$input = range(0, 100);
$input = array_slice($input, 0, 10);
$pdo = ''; // mysql resource
$table = 'country';
$pagination = (new PaginatorFactory(new DbPagintaor($pdo, $table)))->createPaginator($pageNumber, $itemsPerPage);
```


### Running the tests

`phpunit --debug tests/PaginatorTest.php`
