<?php

// namespace Math\projet04\model;

class Post
{
    protected $_id;
    protected $_author;
    protected $_title;
    protected $_content;
    protected $_creationDate;
    protected $_updateDate;

    public function hydrate($data)
    {   
        foreach ($data as $key => $value) {

            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    public function getUpdateDate()
    {
        return $this->_updateDate;
    }

    // SETTERS

    public function setId(int $id)
    {
        $this->_id = $id;
    }

    public function setAuthor(string $author)
    {
        $this->_author = $author;
    }

    public function setTitle(string $title)
    {
        $this->_title = $title;
    }

    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->_updateDate = $updateDate;
    }
}