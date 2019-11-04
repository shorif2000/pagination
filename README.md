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

For `Array` or `ArrayObject` 

```php
$pageNumber = [1];
$options = [
    'data' => [0,1,2,3,4,5,6,7,8,9]
];
$pagination = (new Paginator($options))->paginate($pageNumber);

print_r($pagination->getViewData());
```
results in 

```
Array
(
    [elements] => Array
        (
            [0] => 0
            [1] => 1
            [2] => 2
            [3] => 3
            [4] => 4
            [5] => 5
            [6] => 6
            [7] => 7
            [8] => 8
            [9] => 9
        )

    [currentPage] => 1
    [pages] => 1
    [totalElements] => 10
    [totalElementsOnCurrentPage] => 10
    [totalElementsPerPage] => 10
)

```

You can call the following functions to get data

```php
    public function getItems();

    public function setItems($items);

    public function getCurrentPageNumber(): int;

    public function setCurrentPageNumber($currentPageNumber);

    public function getNumberOfPages(): int;

    public function setNumberOfPages($numberOfPages);

    public function getTotal(): int;

    public function setTotal($total);

    public function getTotalOnCurrentPage(): int;

    public function getTotalPerPage(): int;

    public function getViewData(): array;
```

### Running the tests

`phpunit --debug tests/PaginatorTest.php`
