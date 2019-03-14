<?php

namespace Math\projet04\Model;

class Pagination
{
    protected $_totalPages;
    protected $_currentPage;
    protected $_firstEntry;
    protected $_currentUrl;
    protected $_previousPage;
    protected $_nextPage;
    protected $_notEnoughEntries;
    protected $_elementsToDisplay;

    public function __construct($currentPage, $totalNbRows, $url, $parameters = NULL, $elementNbByPages)
    {
        $this->totalPages($totalNbRows, $elementNbByPages);
        $this->setCurrentPage($currentPage);
        $this->setPreviousPage();
        $this->setNextPage();
        $this->firstEntry($elementNbByPages);
        $this->currentUrl($url, $parameters);
        $this->notEnoughEntries($totalNbRows, $elementNbByPages);
        // $this->elementsToDisplay();
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

    protected function currentUrl($url, $parameters)
    {
        $url = substr($url, 11) . '?';

        if (!$parameters == NULL) {

            $parameters = $parameters[0];

            if (stristr($parameters, 'pageNb')) {
                $parameters = preg_replace('#&pageNb=[0-9]+#', "", $parameters);
            }

            $this->_currentUrl = $url . $parameters;

        } else {
            $this->_currentUrl = $url;
        }
        
    }

    // protected function elementsToDisplay()
    // {
    //     // $nbElementsToDisplay = 5;
    //     // $nbElementsBeforeCurrent = floor(5 / 2);  

    //     $i = $this->getCurrentPage() - 2;

    //     if ($i < 3) {
    //         if ($i == 2) {
    //             $i = $this->getCurrentPage() - 1;
    //         } elseif ($i == 1) {
    //             $i = $this->getCurrentPage() - 2;
    //         }
    //     }

    //     // $array[] = 

    //     for ($i; $i <= $this->getTotalPages(); $i++) {

    //         if ($i == $this->getCurrentPage()) {

    //             $array[] = '<li class="page-item active"><a class="page-link" href="#">'. $i .'</a></li>';

    //         } else {

    //             $array[] = '<li class="page-item"><a class="page-link" href="' . $this->getCurrentUrl() . '&pageNb=' . $i . '">'. $i .'</a></li>';

    //         } 
    //     }

    //     $this->_elementsToDisplay = $array;
    // }

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

    public function getElementsToDisplay()
    {
        return $this->_elementsToDisplay;
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
}