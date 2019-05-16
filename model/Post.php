<?php

namespace Blog\Model;

/**
 * Post
 * 
 * Set or get informations for a post
 */

class Post
{
    /**
     * @var int $_id, the id of a post
     */
    protected $_id;

    /**
     * @var string $_author, the author of a post
     */
    protected $_author;

    /**
     * @var string $_title, the title of a post
     */
    protected $_title;

    /**
     * @var string $_content, the content of a post
     */
    protected $_content;

    /**
     * @var string $_creationDate, the creation date of a post
     */
    protected $_creationDate;

    /**
     * @var string $_updateDate, the update date of a post
     */
    protected $_updateDate;

    /**
     * Set automatically elements in methods
     * 
     * @param array $data
     */
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

    /**
     * Allows to get the id of a post
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the author of a post
     * 
     * @return string $_author
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * Allows to get the title of a post
     * 
     * @return string $_title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Allows to get the content of a post
     * 
     * @return string $_content
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Allows to get the creation date of a post
     * 
     * @return string $_creationDate
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Allows to get the update date of a post
     * 
     * @return string $_updateDate
     */
    public function getUpdateDate()
    {
        return $this->_updateDate;
    }

    // SETTERS

    /**
     * Allows to set the id of a post
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the author of a post
     * 
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->_author = $author;
    }

    /**
     * Allows to set the title of a post
     * 
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->_title = $title;
    }

    /**
     * Allows to set the content of a post
     * 
     * @param string content
     */
    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    /**
     * Allows to set the creation date of a post
     * 
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * Allows to set the update date of a post
     * 
     * @param string $updateDate
     */
    public function setUpdateDate($updateDate)
    {
        $this->_updateDate = $updateDate;
    }
}