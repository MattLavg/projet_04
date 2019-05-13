<?php

namespace Blog\Model;

class Pagination
{
    protected $_totalPages;
    protected $_currentPage;
    protected $_firstEntry;
    protected $_currentUrl;
    protected $_previousPage;
    protected $_nextPage;
    protected $_notEnoughEntries;
    protected $_elementNbByPage;

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

    protected function totalPages($totalNbRows, $elementNbByPages)
    {
        $totalPages = $totalNbRows / $elementNbByPages;
        $totalPages = ceil($totalPages);

        $this->_totalPages = $totalPages;
    }

    protected function firstEntry($elementNbByPages)
    {
        $currentPage = $this->_currentPage - 1;
        $firstEntry = $currentPage * $elementNbByPages;

        $this->_firstEntry = $firstEntry;
    }

    public function render()
    {      
        require(TEMPLATE . 'pagination.php');
    }

    protected function notEnoughEntries($totalNbRows, $elementNbByPages)
    {
        if ($totalNbRows <= $elementNbByPages) {
            $this->_notEnoughEntries = FALSE;
        } else {
            $this->_notEnoughEntries = TRUE;
        }
    }

    // GETTERS

    public function getTotalPages()
    {
        return $this->_totalPages;
    }

    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    public function getFirstEntry()
    {
        return $this->_firstEntry;
    }

    public function getCurrentUrl()
    {
        return $this->_currentUrl;
    }

    public function getPreviousPage()
    {
        return $this->_previousPage;
    }

    public function getNextPage()
    {
        return $this->_nextPage;
    }

    public function getNotEnoughEntries()
    {
        return $this->_notEnoughEntries;
    }

    public function getElementNbByPage()
    {
        return $this->_elementNbByPage;
    }

    // SETTERS

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

    public function setPreviousPage()
    {
        $currentPage = $this->_currentPage - 1;
        
        if ($currentPage == 0) {
            return $this->_previousPage = 1;
        } 

        $this->_previousPage = $currentPage;
    }

    public function setNextPage()
    {
        $currentPage = $this->_currentPage + 1;

        if ($currentPage > $this->_totalPages) {
            return $this->_nextPage = $this->_totalPages;
        } 

        $this->_nextPage = $currentPage;
    }

    public function setCurrentUrl($url)
    {
        $this->_currentUrl = $url;
    }

    public function setElementNbByPage($elementNbByPage)
    {
        $this->_elementNbByPage = $elementNbByPage;
    }
}