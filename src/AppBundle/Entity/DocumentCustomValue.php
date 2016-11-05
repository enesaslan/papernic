<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country
 *
 * @ORM\Table(name="document_custom_value")
 * @ORM\Entity
 */
class DocumentCustomValue
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $custom_value_id;

    /**
     * @ORM\Column(name="custom_field_id", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $custom_field_id;

    /**
     * @ORM\Column(name="document_id", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $document_id;

    /**
     * @ORM\Column(name="value", type="string", length=250, nullable=true)
     */
    protected $value;

    /**
     * Get custom_value_id
     *
     * @return integer 
     */
    public function getCustomValueId()
    {
        return $this->custom_value_id;
    }

    /**
     * Set custom_field_id
     *
     * @param integer $customFieldId
     * @return DocumentCustomValue
     */
    public function setCustomFieldId($customFieldId)
    {
        $this->custom_field_id = $customFieldId;

        return $this;
    }

    /**
     * Get custom_field_id
     *
     * @return integer 
     */
    public function getCustomFieldId()
    {
        return $this->custom_field_id;
    }

    /**
     * Set document_id
     *
     * @param integer $documentId
     * @return DocumentCustomValue
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
     * Set value
     *
     * @param string $value
     * @return DocumentCustomValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
