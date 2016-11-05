<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country
 *
 * @ORM\Table(name="document_category")
 * @ORM\Entity
 */
class DocumentCategory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $document_category_id;

    /**
     * @ORM\Column(name="document_category", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    protected $document_category;

    /**
     * @ORM\Column(name="is_deleted", type="boolean", options={"default" = false})
     */
    protected $is_deleted;

    public function __toString()
    {
        try {
            return strval($this->getDocumentCategoryId());
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Get document_category_id
     *
     * @return integer
     */
    public function getDocumentCategoryId()
    {
        return $this->document_category_id;
    }

    /**
     * Set document_category
     *
     * @param string $documentCategory
     * @return DocumentCategory
     */
    public function setDocumentCategory($documentCategory)
    {
        $this->document_category = $documentCategory;

        return $this;
    }

    /**
     * Get document_category
     *
     * @return string
     */
    public
    function getDocumentCategory()
    {
        return $this->document_category;
    }

    /**
     * Set is_deleted
     *
     * @param boolean $isDeleted
     * @return DocumentCategory
     */
    public
    function setIsDeleted(
        $isDeleted
    ) {
        $this->is_deleted = $isDeleted;

        return $this;
    }

    /**
     * Get is_deleted
     *
     * @return boolean
     */
    public
    function getIsDeleted()
    {
        return $this->is_deleted;
    }
}
