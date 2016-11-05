<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country
 *
 * @ORM\Table(name="document_custom_field")
 * @ORM\Entity
 */
class DocumentCustomField
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $custom_field_id;

    /**
     * @ORM\Column(name="custom_field_name", type="string", length=20, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    protected $custom_field_name;

    /**
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     * @Assert\NotBlank()
     */
    protected $type;

    /**
     * @ORM\Column(name="length", type="smallint", nullable=true)
     */
    protected $length;

    /**
     * @ORM\Column(name="is_required", type="boolean", nullable=false, options={"default" = false})
     */
    protected $is_required;

    /**
     * @ORM\Column(name="lookup_values", type="string", length=256, nullable=true)
     */
    protected $lookup_values;

    /**
     * @ORM\Column(name="row", type="smallint", nullable=true)
     */
    protected $row;

    /**
     * @ORM\Column(name="column", type="smallint", nullable=true)
     */
    protected $column;

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
     * Set custom_field_name
     *
     * @param string $customFieldName
     * @return CustomField
     */
    public function setCustomFieldName($customFieldName)
    {
        $this->custom_field_name = $customFieldName;

        return $this;
    }

    /**
     * Get custom_field_name
     *
     * @return string 
     */
    public function getCustomFieldName()
    {
        return $this->custom_field_name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return CustomField
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return CustomField
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set is_required
     *
     * @param boolean $isRequired
     * @return CustomField
     */
    public function setIsRequired($isRequired)
    {
        $this->is_required = $isRequired;

        return $this;
    }

    /**
     * Get is_required
     *
     * @return boolean 
     */
    public function getIsRequired()
    {
        return $this->is_required;
    }

    /**
     * Set lookup_values
     *
     * @param string $lookupValues
     * @return CustomField
     */
    public function setLookupValues($lookupValues)
    {
        $this->lookup_values = $lookupValues;

        return $this;
    }

    /**
     * Get lookup_values
     *
     * @return string 
     */
    public function getLookupValues()
    {
        return $this->lookup_values;
    }

    /**
     * Set row
     *
     * @param integer $row
     * @return CustomField
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Get row
     *
     * @return integer 
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Set column
     *
     * @param integer $column
     * @return CustomField
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get column
     *
     * @return integer 
     */
    public function getColumn()
    {
        return $this->column;
    }
}
