<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
{
    /**
     * @ORM\Column(type="smallint")
     * @ORM\Id;
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $country_id;

    /**
     * @ORM\Column(name="country", type="string", length=50, nullable=false)
     */
    protected $country;

    public function __toString()
    {
        return strval($this->getCountryId());
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
     * Set country
     *
     * @param string $country
     * @return Country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
