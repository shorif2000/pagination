<?php
namespace Pagination\Lib;

class Pagination_Common
{
    private $_totalItems;
    private $_perPage;
    private $_delta         = 10;
    private $_currentPage   = 1;
    private $_totalPages    = 1;
    
    private $_allowed_options = [
        'totalItems',
        'perPage',
        'delta',
        'currentPage',
    ];
    
    public function __construct($input, $perPage){
        
        $this->_totalItems = $input;
        $this->_perPage = $perPage;
        $this->_totalPages = ceil(count($input) / $perPage);
    }
    
    public function elements() {
    }
    
    
    public function currentPage() {}
    
    public function pages() {}
    
    // current elements
    public function totalElements() {        
        return $this->_totalItems;
    }
    
    // current elements
    public function totalElementsOnCurrentPage() {
        
    }
    
    public function totalElementsPerPage() {
        return $this->_perPage;
    }
    
    public function paginate($pageNumber){
        $this->_currentPage = $pageNumber;
        
    }
    
}