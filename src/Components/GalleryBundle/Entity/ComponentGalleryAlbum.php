<?php

namespace Components\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CmsBundle\Entity\StructureComponent;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * ComponentGalleryAlbum
 *
 * @ORM\Table(name="component_gallery_albums")
 * @ORM\Entity(repositoryClass="Components\GalleryBundle\Repository\ComponentGalleryAlbumRepository")
 * @ExclusionPolicy("all")
 */
class ComponentGalleryAlbum
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
     * @var ComponentGalleryAlbumItem[]
     * @ORM\OneToMany(targetEntity="ComponentGalleryAlbumItem", mappedBy="album")
     * @MaxDepth(2)
     * @Expose
     */
    private $albumItems;

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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="author", type="integer")
     * @Expose
     */
    private $author;

    /**
     * @var bool
     *
     * @ORM\Column(name="activate", type="boolean")
     * @Expose
     */
    private $activate = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt = null;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albumItems = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
     * @return ComponentGalleryAlbum
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
     * Set author
     *
     * @param integer $author
     *
     * @return ComponentGalleryAlbum
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set activate
     *
     * @param boolean $activate
     *
     * @return ComponentGalleryAlbum
     */
    public function setActivate($activate)
    {
        $this->activate = $activate;

        return $this;
    }

    /**
     * Get activate
     *
     * @return bool
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return ComponentGalleryAlbum
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
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
     * @param ComponentGalleryAlbumItem
     */
    public function addAlbumItem(ComponentGalleryAlbumItem $albumItem)
    {
        $this->albumItems[] = $albumItem;
    }

    /**
     * Remove AlbumItem
     *
     * @param ComponentGalleryAlbumItem $albumItem
     */
    public function removeAlbumItem(ComponentGalleryAlbumItem $albumItem)
    {
        $this->albumItems->removeElement($albumItem);
    }

    /**
     * @return ComponentGalleryAlbumItem[]
     */
    public function getAlbumItems()
    {
        return $this->albumItems;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}

