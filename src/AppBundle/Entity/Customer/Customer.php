<?php

namespace AppBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer
 *
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Column(type="smallint")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $customer_id;

    /**
     * @ORM\Column(name="login_id", type="string", length=60, nullable=false, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    protected $login_id;

    /**
     * @ORM\Column(name="customer_name", type="string", length=30, nullable=false)
     * @Assert\NotBlank()
     */
    protected $customer_name;

    /**
     * @ORM\Column(name="email", type="string", length=30, nullable=false, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="account_started", type="integer", nullable=false)
     */
    protected $account_started;

    /**
     * @ORM\Column(name="account_expires", type="integer", nullable=false)
     */
    protected $account_expires;

    /**
     * @ORM\Column(name="database_name", type="string", length=30, nullable=false)
     */
    protected $database_name;

    /**
     * @ORM\Column(name="database_user", type="string", length=30, nullable=false)
     */
    protected $database_user;

    /**
     * @ORM\Column(name="database_password", type="string", length=30, nullable=false)
     */
    protected $database_password;

    /**
     * @ORM\Column(type="boolean", options={"default" = true}, nullable=false)
     */
    protected $is_active;

    /**
     * @ORM\Column(name="account_type", type="string", length=20, nullable=false)
     */
    protected $account_type;

    /**
     * @ORM\Column(name="user_limit", type="smallint", nullable=false)
     */
    protected $user_limit;

    /**
     * @ORM\Column(name="disk_limit", type="integer", nullable=false)
     */
    protected $disk_limit;

    /**
     * Get customer_id
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set login_id
     *
     * @param string $loginId
     * @return Customer
     */
    public function setLoginId($loginId)
    {
        $this->login_id = $loginId;

        return $this;
    }

    /**
     * Get login_id
     *
     * @return string 
     */
    public function getLoginId()
    {
        return $this->login_id;
    }

    /**
     * Set customer_name
     *
     * @param string $customerName
     * @return Customer
     */
    public function setCustomerName($customerName)
    {
        $this->customer_name = $customerName;

        return $this;
    }

    /**
     * Get customer_name
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
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
     * Set account_started
     *
     * @param integer $accountStarted
     * @return Customer
     */
    public function setAccountStarted($accountStarted)
    {
        $this->account_started = $accountStarted;

        return $this;
    }

    /**
     * Get account_started
     *
     * @return integer 
     */
    public function getAccountStarted()
    {
        return $this->account_started;
    }

    /**
     * Set account_expires
     *
     * @param integer $accountExpires
     * @return Customer
     */
    public function setAccountExpires($accountExpires)
    {
        $this->account_expires = $accountExpires;

        return $this;
    }

    /**
     * Get account_expires
     *
     * @return integer 
     */
    public function getAccountExpires()
    {
        return $this->account_expires;
    }

    /**
     * @return mixed
     */
    public function getDatabaseName()
    {
        return $this->database_name;
    }

    /**
     * @param mixed $database_name
     */
    public function setDatabaseName($database_name)
    {
        $this->database_name = $database_name;
    }

    /**
     * @return mixed
     */
    public function getDatabaseUser()
    {
        return $this->database_user;
    }

    /**
     * @param mixed $database_user
     */
    public function setDatabaseUser($database_user)
    {
        $this->database_user = $database_user;
    }

    /**
     * @return mixed
     */
    public function getDatabasePassword()
    {
        return $this->database_password;
    }

    /**
     * @param mixed $database_password
     */
    public function setDatabasePassword($database_password)
    {
        $this->database_password = $database_password;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Customer
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set account_type
     *
     * @param string $accountType
     * @return Customer
     */
    public function setAccountType($accountType)
    {
        $this->account_type = $accountType;

        return $this;
    }

    /**
     * Get account_type
     *
     * @return string 
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * Set user_limit
     *
     * @param integer $userLimit
     * @return Customer
     */
    public function setUserLimit($userLimit)
    {
        $this->user_limit = $userLimit;

        return $this;
    }

    /**
     * Get user_limit
     *
     * @return integer 
     */
    public function getUserLimit()
    {
        return $this->user_limit;
    }

    /**
     * Set disk_limit
     *
     * @param integer $diskLimit
     * @return Customer
     */
    public function setDiskLimit($diskLimit)
    {
        $this->disk_limit = $diskLimit;

        return $this;
    }

    /**
     * Get disk_limit
     *
     * @return integer 
     */
    public function getDiskLimit()
    {
        return $this->disk_limit;
    }
}
