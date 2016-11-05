<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * File
 *
 * @ORM\Table(name="document_file")
 * @ORM\Entity(repositoryClass="DocumentFileRepository")
 */
class DocumentFile
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $file_id;

    /**
     * @ORM\Column(name="document_id", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $document_id;

    /**
     * @ORM\Column(name="path", type="string", length=20, nullable=false)
     * @Assert\NotBlank()
     */
    protected $path;

    /**
     * @ORM\Column(name="file_name", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     */
    protected $file_name;

    /**
     * @ORM\Column(name="size", type="float", nullable=false)
     * @Assert\NotBlank()
     */
    protected $size;

    /**
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $date_added;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $user_id;


    public function __toString()
    {
        try {
            return strval($this->getFileId());
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Get file_id
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * Set document_id
     *
     * @param integer $documentId
     * @return DocumentFile
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
     * Set path
     *
     * @param string $path
     * @return DocumentFile
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file_name
     *
     * @param string $fileName
     * @return DocumentFile
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;

        return $this;
    }

    /**
     * Get file_name
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set date_added
     *
     * @param integer $dateAdded
     * @return DocumentFile
     */
    public function setDateAdded($dateAdded)
    {
        $this->date_added = $dateAdded;

        return $this;
    }

    /**
     * Get date_added
     *
     * @return integer 
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return DocumentFile
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
     * Set size
     *
     * @param float $size
     * @return DocumentFile
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return float 
     */
    public function getSize()
    {
        return $this->size;
    }
}
