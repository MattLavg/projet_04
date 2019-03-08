<?php

namespace Math\projet04\Model;

class Pagination
{
    protected $totalPages;
    protected $currentPage;
    protected $firstEntry;
    protected $currentUrl;
    protected $previousPage;
    protected $nextPage;
    protected $notEnoughEntries;

    public function __construct($currentPage, $totalNbRows, $url, $parameters = NULL, $elementNbByPages)
    {
        $this->totalPages($totalNbRows, $elementNbByPages);
        $this->setCurrentPage($currentPage);
        $this->setPreviousPage();
        $this->setNextPage();
        $this->firstEntry($elementNbByPages);
        $this->currentUrl($url, $parameters);
        $this->notEnoughEntries($totalNbRows, $elementNbByPages);
    }

    public function totalPages($totalNbRows, $elementNbByPages)
    {
        $totalPages = $totalNbRows / $elementNbByPages;
        $totalPages = ceil($totalPages);

        $this->totalPages = $totalPages;
    }

    public function firstEntry($elementNbByPages)
    {
        $currentPage = $this->currentPage - 1;
        $firstEntry = $currentPage * $elementNbByPages;

        $this->firstEntry = $firstEntry;
    }

    public function currentUrl($url, $parameters)
    {
        $url = substr($url, 11) . '?';

        if (!$parameters == NULL) {

            $parameters = $parameters[0];

            if (stristr($parameters, 'pageNb')) {
                $parameters = preg_replace('#&pageNb=[0-9]+#', "", $parameters);
            }

            $this->currentUrl = $url . $parameters;

        } else {
            $this->currentUrl = $url;
        }
        
    }

    public function notEnoughEntries($totalNbRows, $elementNbByPages)
    {
        if ($totalNbRows <= $elementNbByPages) {
            $this->notEnoughEntries = FALSE;
        } else {
            $this->notEnoughEntries = TRUE;
        }
    }

    // GETTERS

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getFirstEntry()
    {
        return $this->firstEntry;
    }

    public function getCurrentUrl()
    {
        return $this->currentUrl;
    }

    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    public function getNextPage()
    {
        return $this->nextPage;
    }

    public function getNotEnoughEntries()
    {
        return $this->notEnoughEntries;
    }

    // SETTERS

    public function setCurrentPage($currentPage)
    {
        if (isset($currentPage)) {
            $this->currentPage = $currentPage;

            if ($this->currentPage > $this->totalPages) {
                $this->currentPage = $this->totalPages;
            }

        } else {
            $this->currentPage = 1;
        }
    }

    public function setPreviousPage()
    {
        $currentPage = $this->currentPage - 1;
        
        if ($currentPage == 0) {
            return $this->previousPage = 1;
        } 

        $this->previousPage = $currentPage;
    }

    public function setNextPage()
    {
        $currentPage = $this->currentPage + 1;

        if ($currentPage > $this->totalPages) {
            return $this->nextPage = $this->totalPages;
        } 

        $this->nextPage = $currentPage;
    }
}