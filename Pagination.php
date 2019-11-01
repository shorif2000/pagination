<?php 
namespace Pagination;

class Pagination
{
    public function __construct($input = [], $perPage = 10, $mode = 'Default')
    {
        $this = Pagination::factory($input, $perPage, $mode);
    }
    
    public static function &factory($input, $perPage, $mode)
    {
        $classname = 'Lib\Pagination_' . $mode;
        // If the class exists, return a new instance of it.
        if (class_exists($classname)) {
            $pagination = new $classname($input, $perPage);
            return $pagination;
        }
        
        $null = null;
        return $null;
    }
}