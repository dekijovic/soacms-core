<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Page
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\LanguageRepository")
 * @ExclusionPolicy("all")
 */
class Language
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="text" , length=255)
     * @Expose
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="prefix", type="text" , length=2)
     * @Expose
     */
    private $prefix;

    /**
     * @var string
     * @ORM\Column(name="icon", type="text" , length=255, nullable=true)
     * @Expose
     */
    private $icon;

    /**
     * @var string
     * @ORM\Column(name="default_lang", type="boolean", nullable=false, options={"default" : false})
     * @Expose
     */
    private $default = false;

    /**
     * @var \DateTime
     * @ORM\Column(name="deleted_at", type="datetime" , nullable=true)
     */
    private $deletedAt;


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
     * Set name
     *
     * @param string $name
     *
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return Language
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Language
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set default
     *
     * @param boolean $default
     *
     * @return Language
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param mixed $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
}
