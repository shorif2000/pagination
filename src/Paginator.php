<?php
namespace Pagination;

use Pagination\Lib\PaginatorInterface;
use Pagination\Lib\DefaultPaginator;
use Pagination\Lib\Collection;
use Pagination\Lib\ArrayData;

class Paginator implements PaginatorInterface
{

    const NUM_PLACEHOLDER = '(:num)';

    protected $totalItems;

    protected $numPages;

    protected $limit;

    protected $currentPage;

    protected $urlPattern;

    protected $maxPagesToShow = 10;

    protected $previousText = 'Previous';

    protected $nextText = 'Next';

    public function __construct($options = [])
    {
        $this->items = $options['data'];
        $this->limit = $options['limit'] ?? 10;
        $this->currentPage = $options['currentPage'] ?? 1;
        //$this->urlPattern = $options['urlPattern'];
        $this->updateNumPages();
    }
    
    public function paginate(int $page = 1): PaginatorInterface
    {
        if ($page <= 0 || $this->limit <= 0) {
            throw new \LogicException("Invalid parameters.");
        }
        $offset = ($page - 1) * $this->limit;
        $pagination = new DefaultPaginator();
        $items = new Collection($this->items, $offset, $this->limit);
        if ($this->items instanceof \ArrayObject || is_array($this->items)) {
            $data = new ArrayData();
            $data->fetchItems($items);
        } else {
            throw new \RuntimeException("Data type not supported for pagination.");
        }
        $pagination->setCurrentPageNumber($page);
        $pagination->setNumberOfPages((int) ceil($items->getCount() / $items->getLimit()));
        $pagination->setItems($items->getItems());
        $pagination->setTotal($items->getCount());
        $pagination->setTotalOnCurrentPage(count($items->getItems()));
        $pagination->setTotalPerPage($this->limit);
        return $pagination;
    }

    protected function updateNumPages()
    {
        $this->numPages = ($this->limit == 0 ? 0 : (int) ceil($this->totalItems / $this->limit));
    }

    public function setMaxPagesToShow($maxPagesToShow)
    {
        if ($maxPagesToShow < 3) {
            throw new \InvalidArgumentException('maxPagesToShow cannot be less than 3.');
        }
        $this->maxPagesToShow = $maxPagesToShow;
    }


    public function getMaxPagesToShow() : int
    {
        return $this->maxPagesToShow;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function getCurrentPage() : int
    {
        return $this->currentPage;
    }

    public function setItemsPerPage(int $limit)
    {
        $this->limit = $limit;
        $this->updateNumPages();
    }

    public function getItemsPerPage() : int
    {
        return $this->limit;
    }

    public function setTotalItems(int $totalItems)
    {
        $this->totalItems = $totalItems;
        $this->updateNumPages();
    }


    public function getTotalItems(): int
    {
        return $this->totalItems;
    }


    public function getNumPages(): int
    {
        return $this->numPages;
    }

    public function setUrlPattern(string $urlPattern)
    {
        $this->urlPattern = $urlPattern;
    }


    public function getUrlPattern(): string
    {
        return $this->urlPattern;
    }


    public function getPageUrl(int $pageNum): string
    {
        return str_replace(self::NUM_PLACEHOLDER, $pageNum, $this->urlPattern);
    }

    public function getNextPage()
    {
        if ($this->currentPage < $this->numPages) {
            return $this->currentPage + 1;
        }
        return null;
    }

    public function getPrevPage()
    {
        if ($this->currentPage > 1) {
            return $this->currentPage - 1;
        }
        return null;
    }

    public function getNextUrl()
    {
        if (! $this->getNextPage()) {
            return null;
        }
        return $this->getPageUrl($this->getNextPage());
    }

    /**
     *
     * @return string|null
     */
    public function getPrevUrl()
    {
        if (! $this->getPrevPage()) {
            return null;
        }
        return $this->getPageUrl($this->getPrevPage());
    }

    /**
     * Get an array of paginated page data.
     *
     * Example:
     * array(
     * array ('num' => 1, 'url' => '/example/page/1', 'isCurrent' => false),
     * array ('num' => '...', 'url' => NULL, 'isCurrent' => false),
     * array ('num' => 3, 'url' => '/example/page/3', 'isCurrent' => false),
     * array ('num' => 4, 'url' => '/example/page/4', 'isCurrent' => true ),
     * array ('num' => 5, 'url' => '/example/page/5', 'isCurrent' => false),
     * array ('num' => '...', 'url' => NULL, 'isCurrent' => false),
     * array ('num' => 10, 'url' => '/example/page/10', 'isCurrent' => false),
     * )
     *
     * @return array
     */
    public function getPages()
    {
        $pages = array();
        if ($this->numPages <= 1) {
            return array();
        }
        if ($this->numPages <= $this->maxPagesToShow) {
            for ($i = 1; $i <= $this->numPages; $i ++) {
                $pages[] = $this->createPage($i, $i == $this->currentPage);
            }
        } else {
            // Determine the sliding range, centered around the current page.
            $numAdjacents = (int) floor(($this->maxPagesToShow - 3) / 2);
            if ($this->currentPage + $numAdjacents > $this->numPages) {
                $slidingStart = $this->numPages - $this->maxPagesToShow + 2;
            } else {
                $slidingStart = $this->currentPage - $numAdjacents;
            }
            if ($slidingStart < 2)
                $slidingStart = 2;
            $slidingEnd = $slidingStart + $this->maxPagesToShow - 3;
            if ($slidingEnd >= $this->numPages)
                $slidingEnd = $this->numPages - 1;
            // Build the list of pages.
            $pages[] = $this->createPage(1, $this->currentPage == 1);
            if ($slidingStart > 2) {
                $pages[] = $this->createPageEllipsis();
            }
            for ($i = $slidingStart; $i <= $slidingEnd; $i ++) {
                $pages[] = $this->createPage($i, $i == $this->currentPage);
            }
            if ($slidingEnd < $this->numPages - 1) {
                $pages[] = $this->createPageEllipsis();
            }
            $pages[] = $this->createPage($this->numPages, $this->currentPage == $this->numPages);
        }
        return $pages;
    }

    /**
     * Create a page data structure.
     *
     */
    protected function createPage(int $pageNum, bool $isCurrent = false): array
    {
        return array(
            'num' => $pageNum,
            'url' => $this->getPageUrl($pageNum),
            'isCurrent' => $isCurrent
        );
    }

    protected function createPageEllipsis(): array
    {
        return array(
            'num' => '...',
            'url' => null,
            'isCurrent' => false
        );
    }

    /**
     * Render an HTML pagination control.
     *
     */
    public function toHtml(): string
    {
        if ($this->numPages <= 1) {
            return '';
        }
        $html = '<ul class="pagination">';
        if ($this->getPrevUrl()) {
            $html .= '<li><a href="' . htmlspecialchars($this->getPrevUrl()) . '">&laquo; ' . $this->previousText . '</a></li>';
        }
        foreach ($this->getPages() as $page) {
            if ($page['url']) {
                $html .= '<li' . ($page['isCurrent'] ? ' class="active"' : '') . '><a href="' . htmlspecialchars($page['url']) . '">' . htmlspecialchars($page['num']) . '</a></li>';
            } else {
                $html .= '<li class="disabled"><span>' . htmlspecialchars($page['num']) . '</span></li>';
            }
        }
        if ($this->getNextUrl()) {
            $html .= '<li><a href="' . htmlspecialchars($this->getNextUrl()) . '">' . $this->nextText . ' &raquo;</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function __toString()
    {
        return $this->toHtml();
    }

    public function getCurrentPageFirstItem()
    {
        $first = ($this->currentPage - 1) * $this->limit + 1;
        if ($first > $this->totalItems) {
            return null;
        }
        return $first;
    }

    public function getCurrentPageLastItem()
    {
        $first = $this->getCurrentPageFirstItem();
        if ($first === null) {
            return null;
        }
        $last = $first + $this->limit - 1;
        if ($last > $this->totalItems) {
            return $this->totalItems;
        }
        return $last;
    }

    public function setPreviousText($text)
    {
        $this->previousText = $text;
        return $this;
    }

    public function setNextText($text)
    {
        $this->nextText = $text;
        return $this;
    }
    public function setTotal($total)
    {}

    public function getItems()
    {}

    public function getNumberOfPages(): int
    {}

    public function setNumberOfPages($numberOfPages)
    {}

    public function getCurrentPageNumber(): int
    {}

    public function setItems($items)
    {}

    public function getTotalOnCurrentPage(): int
    {}

    public function count()
    {}

    public function getTotalPerPage(): int
    {}

    public function getTotal(): int
    {}

    public function setCurrentPageNumber($currentPageNumber)
    {}

    public function getViewData(): array
    {}

    
}