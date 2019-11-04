<?php 
namespace Pagination;

class Pagination
{
    public function __construct($options = [], $mode = 'Default')
    {
        eval('$this = Pagination::factory($options, $mode);');
    }
    
    public static function &factory($options, $mode)
    {
        $classname = ($mode == 'Default') ? 'Pagination\\Paginator' : 'Pagination\\DbPage' ;
        // If the class exists, return a new instance of it.
        if (class_exists($classname)) {
            $pagination = new $classname($options);            
            return $pagination;
        }
        
        $null = null;
        return $null;
    }
}