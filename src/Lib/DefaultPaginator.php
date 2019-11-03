<?php
namespace Pagination\Lib;


class DefaultPaginator extends AbstractCommon
{

    public function getViewData(): array
    {
        return [
            'elements' => $this->getItems(),
            'currentPage' => $this->getCurrentPageNumber(),
            'pages' => $this->getNumberOfPages(),
            'totalElements' => $this->getTotal(),
            'totalElementsOnCurrentPage' => $this->getTotalOnCurrentPage(),
            'totalElementsPerPage' => $this->getTotalPerPage(),
        ];
    }
}