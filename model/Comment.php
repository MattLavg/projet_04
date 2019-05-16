<?php

namespace BLog\Model;

/**
 * Comment
 * 
 * Set or get informations for a comment
 */

class Comment
{
    /**
     * @var int $_id the id of a comment
     */
    protected $_id;

    /**
     * @var int $_postId the id of the post where the comment is displayed
     */
    protected $_postId;

    /**
     * @var string $_author the author of a comment
     */
    protected $_author;

    /**
     * @var string $_content the content of a comment
     */
    protected $_content;

    /**
     * @var string $_creationDate the creation date of a comment
     */
    protected $_creationDate;

    /**
     * @var bool $_reported is true if comment is reported
     */
    protected $_reported;

    /**
     * @var bool $_isAdmin is true if is admin
     */
    protected $_isAdmin;

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
     * Allows to get the id of a comment
     * 
     * @return int $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Allows to get the post id of a comment
     * 
     * @return int $_postId
     */
    public function getPostId()
    {
        return $this->_postId;
    }

    /**
     * Allows to get the author of a comment
     * 
     * @return string $_author
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * Allows to get the content of a comment
     * 
     * @return string $_content
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Allows to get the creation date of a comment
     * 
     * @return string $_creationDate
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Allows to know if a comment is reported
     * 
     * @return bool $_reported
     */
    public function getreported()
    {
        return $this->_reported;
    }

    /**
     * Allows to know if user is admin
     * 
     * @return bool $_isAdmin
     */
    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }

    // SETTERS

    /**
     * Allows to set the id of a comment
     * 
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Allows to set the post id of a comment
     * 
     * @param int $postId
     */
    public function setPostId(int $postId)
    {
        $this->_postId = $postId;
    }

    /**
     * Allows to set the author of a comment
     * 
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->_author = $author;
    }

    /**
     * Allows to set the content of a comment
     * 
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->_content = $content;
    }

    /**
     * Allows to set the creation date of a comment
     * 
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * Allows to set if a comment is reported
     * 
     * @param bool $reported
     */
    public function setReported($reported)
    {
        $this->_reported = $reported;
    }

    /**
     * Allows to set if a user is admin
     * 
     * @param bool $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->_isAdmin = $isAdmin;
    }
}