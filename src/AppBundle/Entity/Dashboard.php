<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DashboardRepository")
 * @ORM\Table(name="dashboard")
 */
class Dashboard
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $dashboard_id;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    protected $user_id;

    /**
     * @ORM\Column(name="message", type="string", length=250, nullable=false)
     */
    protected $message;

    /**
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    protected $timestamp;

    protected $formatted;

    public function __toString()
    {
        return strval($this->getDashboardId());
    }

    /**
     * Get dashboard_id
     *
     * @return integer 
     */
    public function getDashboardId()
    {
        return $this->dashboard_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Dashboard
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
     * Set message
     *
     * @param string $message
     * @return Dashboard
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Dashboard
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getFormatted()
    {
        return $this->formatted;
    }

    /**
     * @param mixed $formatted
     */
    public function setFormatted($formatted)
    {
        $this->formatted = $formatted;
    }
}
