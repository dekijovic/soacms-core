<?php

namespace Components\HomepageSliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CmsBundle\Entity\StructureComponent;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * ComponentSliderMeta
 *
 * @ORM\Table(name="component_slider_meta")
 * @ORM\Entity(repositoryClass="Components\HomepageSliderBundle\Repository\ComponentSliderMetaRepository")
 */
class ComponentSliderMeta
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
     * @var ComponentSlider
     *
     * @ORM\ManyToOne(targetEntity="ComponentSlider", inversedBy="items")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id", nullable=false)
     * @MaxDepth(1)
     * @Expose
     */
    private $slider;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $color;

    /**
     * @var \DateTime;
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Expose
     */
    private $deletedAt;

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
     * Set title
     *
     * @param string $title
     *
     * @return ComponentSliderMeta
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ComponentSliderMeta
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return ComponentSliderMeta
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return ComponentSliderMeta
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return ComponentSliderMeta
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
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

    /**
     * @return ComponentSlider
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * @param ComponentSlider $slider
     */
    public function setSlider($slider)
    {
        $this->slider = $slider;
    }


}

