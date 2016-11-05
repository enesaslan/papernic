<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country
 *
 * @ORM\Table(name="document_type")
 * @ORM\Entity
 */
class DocumentType
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $document_type_id;

    /**
     * @ORM\Column(name="document_type", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    protected $document_type;

    /**
     * @ORM\Column(name="is_deleted", type="boolean", options={"default" = false})
     */
    protected $is_deleted;

    public function __toString()
    {
        try {
            return strval($this->getDocumentTypeId());
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Get document_type_id
     *
     * @return integer
     */
    public function getDocumentTypeId()
    {
        return $this->document_type_id;
    }

    /**
     * Set document_type
     *
     * @param string $documentType
     * @return DocumentType
     */
    public function setDocumentType($documentType)
    {
        $this->document_type = $documentType;

        return $this;
    }

    /**
     * Get document_type
     *
     * @return string
     */
    public function getDocumentType()
    {
        return $this->document_type;
    }

    /**
     * Set is_deleted
     *
     * @param boolean $isDeleted
     * @return DocumentType
     */
    public function setIsDeleted($isDeleted)
    {
        $this->is_deleted = $isDeleted;

        return $this;
    }

    /**
     * Get is_deleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }
}
