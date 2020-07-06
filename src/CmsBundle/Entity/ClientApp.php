<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientApp
 *
 * @ORM\Table(name="client_app")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\ClientAppRepository")
 */
class ClientApp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="grant_type", type="string", length=255)
     */
    private $grantType;

    /**
     * @var array
     *
     * @ORM\Column(name="key_data", type="json_array")
     */
    private $keyData;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grantType
     *
     * @param string $grantType
     *
     * @return ClientApp
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;

        return $this;
    }

    /**
     * Get grantType
     *
     * @return string
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * Set keyData
     *
     * @param array $keyData
     *
     * @return ClientApp
     */
    public function setKeyData($keyData)
    {
        $this->keyData = $keyData;

        return $this;
    }

    /**
     * Get keyData
     *
     * @return array
     */
    public function getKeyData()
    {
        return $this->keyData;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    
}

