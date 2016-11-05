<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="ContactRepository")
 * @ORM\Table(name="contact")
 */
class Contact
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $contact_id;

    /**
     * @ORM\Column(type="smallint", options={"default = 1"})
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"1", "2"})
     */
    protected $contact_type;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank()
     */
    protected $contact_name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $citizenship_no;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $tax_id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tax_office;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $gsm;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $fax;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $im;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $web;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $country_id;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $notes;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=true)
     */
    protected $is_deleted;

    public function __toString()
    {
        try {
            return strval($this->getContactId());
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * Get contact_id
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * Set contact_type
     *
     * @param integer $contactType
     * @return Contact
     */
    public function setContactType($contactType)
    {
        $this->contact_type = $contactType;

        return $this;
    }

    /**
     * Get contact_type
     *
     * @return integer 
     */
    public function getContactType()
    {
        return $this->contact_type;
    }

    /**
     * Set contact_name
     *
     * @param string $contactName
     * @return Contact
     */
    public function setContactName($contactName)
    {
        $this->contact_name = $contactName;

        return $this;
    }

    /**
     * Get contact_name
     *
     * @return string 
     */
    public function getContactName()
    {
        return $this->contact_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set citizenship_no
     *
     * @param string $citizenshipNo
     * @return Contact
     */
    public function setCitizenshipNo($citizenshipNo)
    {
        $this->citizenship_no = $citizenshipNo;

        return $this;
    }

    /**
     * Get citizenship_no
     *
     * @return string 
     */
    public function getCitizenshipNo()
    {
        return $this->citizenship_no;
    }

    /**
     * Set tax_id
     *
     * @param string $taxId
     * @return Contact
     */
    public function setTaxId($taxId)
    {
        $this->tax_id = $taxId;

        return $this;
    }

    /**
     * Get tax_id
     *
     * @return string 
     */
    public function getTaxId()
    {
        return $this->tax_id;
    }

    /**
     * Set tax_office
     *
     * @param string $taxOffice
     * @return Contact
     */
    public function setTaxOffice($taxOffice)
    {
        $this->tax_office = $taxOffice;

        return $this;
    }

    /**
     * Get tax_office
     *
     * @return string 
     */
    public function getTaxOffice()
    {
        return $this->tax_office;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set gsm
     *
     * @param string $gsm
     * @return Contact
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;

        return $this;
    }

    /**
     * Get gsm
     *
     * @return string 
     */
    public function getGsm()
    {
        return $this->gsm;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Contact
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set instant_messaging_id
     *
     * @param string $instantMessagingId
     * @return Contact
     */
    public function setInstantMessagingId($instantMessagingId)
    {
        $this->instant_messaging_id = $instantMessagingId;

        return $this;
    }

    /**
     * Get instant_messaging_id
     *
     * @return string 
     */
    public function getInstantMessagingId()
    {
        return $this->instant_messaging_id;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Contact
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set country_id
     *
     * @param integer $countryId
     * @return Contact
     */
    public function setCountryId($countryId)
    {
        $this->country_id = $countryId;

        return $this;
    }

    /**
     * Get country_id
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Contact
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
     * Set is_deleted
     *
     * @param boolean $isDeleted
     * @return Contact
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
     * Set im
     *
     * @param string $im
     * @return Contact
     */
    public function setIm($im)
    {
        $this->im = $im;

        return $this;
    }

    /**
     * Get im
     *
     * @return string 
     */
    public function getIm()
    {
        return $this->im;
    }
}
