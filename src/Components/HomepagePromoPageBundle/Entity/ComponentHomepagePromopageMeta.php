<?php

namespace Components\HomepagePromoPageBundle\Entity;

use CmsBundle\Entity\StructureComponent;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentHomepagePromopageMeta
 *
 * @ORM\Table(name="component_homepage_promopage_meta")
 * @ORM\Entity(repositoryClass="Components\HomepagePromoPageBundle\Repository\ComponentHomepagePromopageMetaRepository")
 * @ExclusionPolicy("all")
 */
class ComponentHomepagePromopageMeta
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
     * @var StructureComponent
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureComponent")
     * @MaxDepth(1)
     * @Expose
     */
    private $structureComponent;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     * @Expose
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     * @Expose
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     * @Expose
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="background_color", type="string", length=16, nullable=true)
     * @Expose
     */
    private $backgroundColor;

    /**
     * @var int
     * @ORM\Column(name="type", type="smallint", nullable=false)
     * @Expose
     */
    private $type = 1;

    /**
     * @var \DateTime;
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
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
     * @return ComponentHomepagePromopageMeta
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
     * Set content
     *
     * @param string $content
     *
     * @return ComponentHomepagePromopageMeta
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return ComponentHomepagePromopageMeta
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
     * Set img
     *
     * @param string $img
     *
     * @return ComponentHomepagePromopageMeta
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
     * Set backgroundColor
     *
     * @param string $backgroundColor
     *
     * @return ComponentHomepagePromopageMeta
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return StructureComponent
     */
    public function getStructureComponent()
    {
        return $this->structureComponent;
    }

    /**
     * @param StructureComponent $structureComponent
     */
    public function setStructureComponent($structureComponent)
    {
        $this->structureComponent = $structureComponent;
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

