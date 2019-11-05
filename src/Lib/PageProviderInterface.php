<?php
namespace Pagination\Lib;
interface PageProviderInterface
{
    public function getTotalCount(): int;
    public function getPage(int $offset, int $limit): \Iterator;
}