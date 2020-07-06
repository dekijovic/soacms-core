<?php

namespace Components\GalleryBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * ComponentGalleryAlbumItem
 *
 * @ORM\Table(name="component_gallery_album_items")
 * @ORM\Entity(repositoryClass="Components\GalleryBundle\Repository\ComponentGalleryAlbumItemRepository")
 * @ExclusionPolicy("all")
 */
class ComponentGalleryAlbumItem
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
     * @var ComponentGalleryAlbum
     *
     * @ORM\ManyToOne(targetEntity="ComponentGalleryAlbum", inversedBy="albumItems")
     * @MaxDepth(1)
     * @Expose
     */
    private $album;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=255)
     * @Expose
     */
    private $thumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     * @Expose
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="exclude", type="boolean")
     * @Expose
     */
    private $exclude = false;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     * @Expose
     */
    private $img;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt = null;

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
     * Set filename
     *
     * @param string $filename
     *
     * @return ComponentGalleryAlbumItem
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return ComponentGalleryAlbumItem
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ComponentGalleryAlbumItem
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
     * Set exclude
     *
     * @param boolean $exclude
     *
     * @return ComponentGalleryAlbumItem
     */
    public function setExclude($exclude)
    {
        $this->exclude = $exclude;

        return $this;
    }

    /**
     * Get exclude
     *
     * @return bool
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ComponentGalleryAlbumItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return ComponentGalleryAlbumItem
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
     * @return mixed
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param mixed $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

}

