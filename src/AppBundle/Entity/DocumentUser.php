<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentUser
 * @ORM\Entity
 * @ORM\Table(name="document_user")
 */
class DocumentUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="document_id", type="integer")
     */
    protected $document_id;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $user_id;

    /**
     * @ORM\Column(name="from_user_id", type="integer")
     */
    protected $from_user_id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set document_id
     *
     * @param integer $documentId
     * @return DocumentUser
     */
    public function setDocumentId($documentId)
    {
        $this->document_id = $documentId;

        return $this;
    }

    /**
     * Get document_id
     *
     * @return integer
     */
    public function getDocumentId()
    {
        return $this->document_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return DocumentUser
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set from_user_id
     *
     * @param integer $fromUserId
     * @return DocumentUser
     */
    public function setFromUserId($fromUserId)
    {
        $this->from_user_id = $fromUserId;

        return $this;
    }

    /**
     * Get from_user_id
     *
     * @return integer
     */
    public function getFromUserId()
    {
        return $this->from_user_id;
    }
}
