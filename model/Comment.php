<?php

namespace model;

class Comment
{
    protected $_id;
    protected $_postId;
    protected $_author;
    protected $_content;
    protected $_creationDate;
    protected $_reported;
    protected $_isAuthor;

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

    public function getPostId()
    {
        return $this->_postId;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    public function getreported()
    {
        return $this->_reported;
    }

    public function getIsAuthor()
    {
        return $this->_isAuthor;
    }

    // SETTERS

    public function setId(int $id)
    {
        $this->_id = $id;
    }

    public function setPostId(int $postId)
    {
        $this->_postId = $postId;
    }

    public function setAuthor(string $author)
    {
        $this->_author = $author;
    }

    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    public function setReported($reported)
    {
        $this->_reported = $reported;
    }

    public function setIsAuthor($isAuthor)
    {
        $this->_isAuthor = $isAuthor;
    }
}