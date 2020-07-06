<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\ConfigRepository")
 * @ExclusionPolicy("all")
 */
class Config
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
     * @ORM\Column(name="param_key", type="text" , length=255)
     * @Expose
     */
    private $paramKey;

    /**
     * @var mixed
     *
     * @ORM\Column(name="param_value", type="json_array", nullable=true)
     * @Expose
     */
    private $paramValue;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return Config
     */
    public function setParamKey($key)
    {
        $this->paramKey = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getParamKey()
    {
        return $this->paramKey;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Config
     */
    public function setParamValue($value)
    {
        if(!is_array($value)){
            $value = ["value" =>$value];
        }
        $this->paramValue = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getParamValue()
    {
        $keys = array_keys($this->paramValue);
        if($keys[0] == "value"){
           return $this->paramValue["value"];
        }
        return $this->paramValue;
    }
}
