<?php

namespace Blog\Model;

/**
 * Pagination
 * 
 * Allows to display pagination on pages
 */

class Pagination
{
    /**
     * @var int $_totalPages the total number of pages
     */
    protected $_totalPages;

    /**
     * @var int $_currentPage the number of the current page
     */
    protected $_currentPage;

    /**
     * @var int $_firstEntry the number of the first entry
     */
    protected $_firstEntry;

    /**
     * @var string $_currentUrl the current url
     */
    protected $_currentUrl;

    /**
     * @var int $_previousPage the number of the previous page
     */
    protected $_previousPage;

    /**
     * @var int $_nextPage the number of the next page
     */
    protected $_nextPage;

    /**
     * @var bool $_notEnoughEntries is true if there are enough elements to display on page
     */
    protected $_notEnoughEntries;

    /**
     * @var int $_elementNbByPage the number of elements to display on a page
     */
    protected $_elementNbByPage;

    /**
     * Allows to define the number of total pages and the current, previous and next pages
     * Allows to define the number of elements by pages, the first entry, the current url and if there are enought entries to display on page
     */
    public function __construct($currentPage, $totalNbRows, $url, $elementNbByPages)
    {
        $this->totalPages($totalNbRows, $elementNbByPages);
        $this->setCurrentPage($currentPage);
        $this->setPreviousPage();
        $this->setNextPage();
        $this->setElementNbByPage($elementNbByPages);
        $this->firstEntry($elementNbByPages);
        $this->setCurrentUrl($url);
        $this->notEnoughEntries($totalNbRows, $elementNbByPages);
    }

    /**
     * Allows to calculate the number of total pages
     * 
     * @param int $totalNbRows
     * @param int $elementNbByPages
     */
    protected function totalPages($totalNbRows, $elementNbByPages)
    {
        $totalPages = $totalNbRows / $elementNbByPages;
        $totalPages = ceil($totalPages);

        $this->_totalPages = $totalPages;
    }

    /**
     * Allows to calculate the first entry
     * 
     * @param int $elementNbByPages
     */
    protected function firstEntry($elementNbByPages)
    {
        $currentPage = $this->_currentPage - 1;
        $firstEntry = $currentPage * $elementNbByPages;

        $this->_firstEntry = $firstEntry;
    }

    /**
     * Allows to display the pagination template
     */
    public function render()
    {      
        require(TEMPLATE . 'pagination.php');
    }

    /**
     * Allows to check is there are enough elements to display
     * 
     * @param int $totalNbRows
     * @param int $elementNbByPages
     */
    protected function notEnoughEntries($totalNbRows, $elementNbByPages)
    {
        if ($totalNbRows <= $elementNbByPages) {
            $this->_notEnoughEntries = FALSE;
        } else {
            $this->_notEnoughEntries = TRUE;
        }
    }

    // GETTERS

    /**
     * Allows to get the number of total pages
     * 
     * @return int $_totalPages
     */
    public function getTotalPages()
    {
        return $this->_totalPages;
    }

    /**
     * Allows to get the number of the current page
     * 
     * @return int $_currentPage
     */
    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    /**
     * Allows to get the number of the first entry
     * 
     * @return int $_firstEntry
     */
    public function getFirstEntry()
    {
        return $this->_firstEntry;
    }

    /**
     * Allows to get the current url
     * 
     * @return string $_currentUrl
     */
    public function getCurrentUrl()
    {
        return $this->_currentUrl;
    }

    /**
     * Allows to get the number of the previous page
     * 
     * @return int $_previousPage
     */
    public function getPreviousPage()
    {
        return $this->_previousPage;
    }

    /**
     * Allows to get the number of the next page
     * 
     * @return int $_nextPage
     */
    public function getNextPage()
    {
        return $this->_nextPage;
    }

    /**
     * Allows to check if the are enough entries to dipslay on page
     * 
     * @return bool $_notEnoughEntries
     */
    public function getNotEnoughEntries()
    {
        return $this->_notEnoughEntries;
    }

    /**
     * Allows to get the number of elements to display on a page
     */
    public function getElementNbByPage()
    {
        return $this->_elementNbByPage;
    }

    // SETTERS

    /**
     * Allows to set the current page
     * 
     * @param string $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        if (isset($currentPage)) {
            $this->_currentPage = $currentPage;

            if ($this->_currentPage > $this->_totalPages) {
                $this->_currentPage = $this->_totalPages;
            }

        } else {
            $this->_currentPage = 1;
        }
    }

    /**
     * Allows to set the previous page
     */
    public function setPreviousPage()
    {
        $currentPage = $this->_currentPage - 1;
        
        if ($currentPage == 0) {
            return $this->_previousPage = 1;
        } 

        $this->_previousPage = $currentPage;
    }

    /**
     * Allows to set the next page
     */
    public function setNextPage()
    {
        $currentPage = $this->_currentPage + 1;

        if ($currentPage > $this->_totalPages) {
            return $this->_nextPage = $this->_totalPages;
        } 

        $this->_nextPage = $currentPage;
    }

    /**
     * Allows to set the current url
     * 
     * @param string $url
     */
    public function setCurrentUrl($url)
    {
        $this->_currentUrl = $url;
    }

    /**
     * Allows to set the number of elements to be displayed by pages
     * 
     * @return int $elementNbByPage 
     */
    public function setElementNbByPage($elementNbByPage)
    {
        $this->_elementNbByPage = $elementNbByPage;
    }
}