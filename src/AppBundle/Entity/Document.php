<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DocumentRepository")
 * @ORM\Table(name="document")
 */
class Document
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $document_id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $document_subject;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $document_no;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $document_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $from_contact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $to_contact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $category_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $type_id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $filing_cabinet_no;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $expiry_date;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $notes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $date_added;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $user_id;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=true)
     */
    protected $is_private;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=true)
     */
    protected $is_deleted;

    /**
     * @ORM\Column(type="boolean", options={"default" = true}, nullable=true)
     */
    protected $is_temp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $temp_timestamp;

    public $date_format;

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
     * Set subject
     *
     * @param string $subject
     * @return Document
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set from_contact
     *
     * @param integer $fromContact
     * @return Document
     */
    public function setFromContact($fromContact)
    {
        $this->from_contact = $fromContact;

        return $this;
    }

    /**
     * Get from_contact
     *
     * @return integer
     */
    public function getFromContact()
    {
        return $this->from_contact;
    }

    /**
     * Set to_contact
     *
     * @param integer $toContact
     * @return Document
     */
    public function setToContact($toContact)
    {
        $this->to_contact = $toContact;

        return $this;
    }

    /**
     * Get to_contact
     *
     * @return integer
     */
    public function getToContact()
    {
        return $this->to_contact;
    }

    /**
     * Set category_id
     *
     * @param integer $categoryId
     * @return Document
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set type_id
     *
     * @param integer $typeId
     * @return Document
     */
    public function setTypeId($typeId)
    {
        $this->type_id = $typeId;

        return $this;
    }

    /**
     * Get type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set cabinet_id
     *
     * @param integer $cabinetId
     * @return Document
     */
    public function setCabinetId($cabinetId)
    {
        $this->cabinet_id = $cabinetId;

        return $this;
    }

    /**
     * Get cabinet_id
     *
     * @return integer
     */
    public function getCabinetId()
    {
        return $this->cabinet_id;
    }

    /**
     * Set cabinet_shelf_no
     *
     * @param string $cabinetShelfNo
     * @return Document
     */
    public function setCabinetShelfNo($cabinetShelfNo)
    {
        $this->cabinet_shelf_no = $cabinetShelfNo;

        return $this;
    }

    /**
     * Get cabinet_shelf_no
     *
     * @return string
     */
    public function getCabinetShelfNo()
    {
        return $this->cabinet_shelf_no;
    }

    /**
     * Set cabinet_shelf_order
     *
     * @param string $cabinetShelfOrder
     * @return Document
     */
    public function setCabinetShelfOrder($cabinetShelfOrder)
    {
        $this->cabinet_shelf_order = $cabinetShelfOrder;

        return $this;
    }

    /**
     * Get cabinet_shelf_order
     *
     * @return string
     */
    public function getCabinetShelfOrder()
    {
        return $this->cabinet_shelf_order;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Document
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set date_added
     *
     * @param integer $dateAdded
     * @return Document
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
     * @return Document
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
     * Set shared
     *
     * @param integer $shared
     * @return Document
     */
    public function setShared($shared)
    {
        $this->shared = $shared;

        return $this;
    }

    /**
     * Get shared
     *
     * @return integer
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * Set is_private
     *
     * @param boolean $isPrivate
     * @return Document
     */
    public function setIsPrivate($isPrivate)
    {
        $this->is_private = $isPrivate;

        return $this;
    }

    /**
     * Get is_private
     *
     * @return boolean
     */
    public function getIsPrivate()
    {
        return $this->is_private;
    }

    /**
     * Set is_deleted
     *
     * @param boolean $isDeleted
     * @return Document
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

    /**
     * Set is_temp
     *
     * @param boolean $isTemp
     * @return Document
     */
    public function setIsTemp($isTemp)
    {
        $this->is_temp = $isTemp;

        return $this;
    }

    /**
     * Get is_temp
     *
     * @return boolean
     */
    public function getIsTemp()
    {
        return $this->is_temp;
    }

    /**
     * Set temp_timestamp
     *
     * @param integer $tempTimestamp
     * @return Document
     */
    public function setTempTimestamp($tempTimestamp)
    {
        $this->temp_timestamp = $tempTimestamp;

        return $this;
    }

    /**
     * Get temp_timestamp
     *
     * @return integer
     */
    public function getTempTimestamp()
    {
        return $this->temp_timestamp;
    }

    /**
     * Set document_subject
     *
     * @param string $documentSubject
     * @return Document
     */
    public function setDocumentSubject($documentSubject)
    {
        $this->document_subject = $documentSubject;

        return $this;
    }

    /**
     * Get document_subject
     *
     * @return string
     */
    public function getDocumentSubject()
    {
        return $this->document_subject;
    }

    /**
     * Set document_no
     *
     * @param string $documentNo
     * @return Document
     */
    public function setDocumentNo($documentNo)
    {
        $this->document_no = $documentNo;

        return $this;
    }

    /**
     * Get document_no
     *
     * @return string
     */
    public function getDocumentNo()
    {
        return $this->document_no;
    }

    /**
     * Set filing_cabinet_no
     *
     * @param string $filingCabinetNo
     * @return Document
     */
    public function setFilingCabinetNo($filingCabinetNo)
    {
        $this->filing_cabinet_no = $filingCabinetNo;

        return $this;
    }

    /**
     * Get filing_cabinet_no
     *
     * @return string
     */
    public function getFilingCabinetNo()
    {
        return $this->filing_cabinet_no;
    }

    /**
     * Set document_date
     *
     * @param \DateTime $documentDate
     * @return Document
     */
    public function setDocumentDate($documentDate)
    {
        $this->document_date = $documentDate;

        return $this;
    }

    /**
     * Get document_date
     *
     * @return \DateTime 
     */
    public function getDocumentDate()
    {
        return $this->document_date;
    }

    /**
     * Set expiry_date
     *
     * @param \DateTime $expiryDate
     * @return Document
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiry_date = $expiryDate;

        return $this;
    }

    /**
     * Get expiry_date
     *
     * @return \DateTime 
     */
    public function getExpiryDate()
    {
        return $this->expiry_date;
    }
}
