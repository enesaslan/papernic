<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    protected $user_name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $full_name;

    /**
     * @ORM\Column(type="boolean", options={"default" = false}, nullable=false)
     */
    protected $is_deleted;

    /**
     * @ORM\Column(type="string", length=1000, options={"default" = "a:0:{}"}, nullable=true)
     */
    protected $options;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $session_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $session_timestamp;

    protected $is_online;

    protected $is_admin;

    /**
     * @return mixed
     */
    public function getOptions()
    {
        $opt = unserialize($this->options);

        if (!array_key_exists('is_admin', $opt)) {
            $opt['is_admin'] = true;
        }

        if (!array_key_exists('priv_document_add', $opt)) {
            $opt['priv_document_add'] = true;
        }

        if (!array_key_exists('priv_document_edit', $opt)) {
            $opt['priv_document_edit'] = true;
        }

        if (!array_key_exists('priv_document_delete', $opt)) {
            $opt['priv_document_delete'] = true;
        }

        if (!array_key_exists('priv_contact_add', $opt)) {
            $opt['priv_contact_add'] = true;
        }

        if (!array_key_exists('priv_contact_edit', $opt)) {
            $opt['priv_contact_edit'] = true;
        }

        if (!array_key_exists('priv_contact_delete', $opt)) {
            $opt['priv_contact_delete'] = true;
        }

        if (!array_key_exists('priv_file_upload', $opt)) {
            $opt['priv_file_upload'] = true;
        }

        if (!array_key_exists('priv_file_download', $opt)) {
            $opt['priv_file_download'] = true;
        }

        if (!array_key_exists('priv_file_delete', $opt)) {
            $opt['priv_file_delete'] = true;
        }

        if (!array_key_exists('smtp_email', $opt)) {
            $opt['smtp_email'] = '';
        }

        if (!array_key_exists('smtp_host_name', $opt)) {
            $opt['smtp_host_name'] = '';
        }

        if (!array_key_exists('smtp_user_name', $opt)) {
            $opt['smtp_user_name'] = '';
        }

        if (!array_key_exists('smtp_password', $opt)) {
            $opt['smtp_password'] = '';
        }

        if (!array_key_exists('smtp_auth_mode', $opt)) {
            $opt['smtp_auth_mode'] = 'login';
        }

        if (!array_key_exists('smtp_encryption', $opt)) {
            $opt['smtp_encryption'] = '';
        }

        if (!array_key_exists('smtp_port', $opt)) {
            $opt['smtp_port'] = 587;
        }

        if (!array_key_exists('contact_list_show', $opt)) {
            $opt['contact_list_show'] = 20;
        }

        if (!array_key_exists('document_list_show', $opt)) {
            $opt['document_list_show'] = 20;
        }

        if (!array_key_exists('date_format', $opt)) {
            $opt['date_format'] = '';
        }

        if (!array_key_exists('time_format', $opt)) {
            $opt['time_format'] = 'H:i';
        }

        $this->setOptions($opt);

        return $opt;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = serialize($options);
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
     * Set user_name
     *
     * @param string $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->user_name = $userName;

        return $this;
    }

    /**
     * Get user_name
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set full_name
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;

        return $this;
    }

    /**
     * Get full_name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Set is_deleted
     *
     * @param integer $isDeleted
     * @return User
     */
    public function setIsDeleted($isDeleted)
    {
        $this->is_deleted = $isDeleted;

        return $this;
    }

    /**
     * Get is_deleted
     *
     * @return integer
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set session_id
     *
     * @param string $sessionId
     * @return User
     */
    public function setSessionId($sessionId)
    {
        $this->session_id = $sessionId;

        return $this;
    }

    /**
     * Get session_id
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Set session_timestamp
     *
     * @param integer $sessionTimestamp
     * @return User
     */
    public function setSessionTimestamp($sessionTimestamp)
    {
        $this->session_timestamp = $sessionTimestamp;

        return $this;
    }

    /**
     * Get session_timestamp
     *
     * @return integer 
     */
    public function getSessionTimestamp()
    {
        return $this->session_timestamp;
    }

    /**
     * @return mixed
     */
    public function getIsOnline()
    {
        return $this->is_online;
    }

    /**
     * @param mixed $is_online
     */
    public function setIsOnline($is_online)
    {
        $this->is_online = $is_online;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $is_admin
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }
}
