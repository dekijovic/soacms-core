<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * Page
 *
 * @ORM\Table(name="structure_levels")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\StructureLevelRepository")
 * @ExclusionPolicy("all")
 */
class StructureLevel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"listLevels", "oneLevel"})
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"listLevels", "oneLevel"})
     * @Expose
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="StructureItem", mappedBy="level")
     * @Groups({"oneLevel"})
     * @MaxDepth(2)
     * @Expose
     */
    private $structureItem;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->structureItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return StructureLevel
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return StructureLevel
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
     * Add structureItem
     *
     * @param \CmsBundle\Entity\StructureItem $structureItem
     *
     * @return StructureLevel
     */
    public function addStructureItem(\CmsBundle\Entity\StructureItem $structureItem)
    {
        $this->structureItem[] = $structureItem;

        return $this;
    }

    /**
     * Remove structureItem
     *
     * @param \CmsBundle\Entity\StructureItem $structureItem
     */
    public function removeStructureItem(\CmsBundle\Entity\StructureItem $structureItem)
    {
        $this->structureItem->removeElement($structureItem);
    }

    /**
     * Get structureItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }
}
