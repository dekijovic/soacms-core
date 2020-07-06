<?php

namespace Components\HomepageSliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CmsBundle\Entity\StructureComponent;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * ComponentSlider
 *
 * @ORM\Table(name="component_slider")
 * @ORM\Entity(repositoryClass="Components\HomepageSliderBundle\Repository\ComponentSliderRepository")
 * @ExclusionPolicy("all")
 */
class ComponentSlider
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("getOne")
     * @Expose
     */
    private $id;

    /**
     * @var StructureComponent
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureComponent")
     * @ORM\JoinColumn(name="structure_component_id", referencedColumnName="id", nullable=false)
     * @MaxDepth(1)
     * @Expose
     */
    private $structureComponent;

    /**
     * @var ComponentSliderMeta[]
     * @ORM\OneToMany(targetEntity="ComponentSliderMeta", mappedBy="slider", cascade ={"remove", "persist", "refresh", "merge", "detach"})
     * @SerializedName("items")
     * @MaxDepth(2)
     * @Groups("getOne")
     * @Expose
     */
    private $items;

    /**
     * @var
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     * @Type("string")
     * @SerializedName("type")
     * @Groups("getOne")
     * @Expose
     */
    private $type;
    /**
     * @var
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Type("string")
     * @SerializedName("description")
     * @Groups("getOne")
     * @Expose
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta", type="json_array", nullable=true)
     * @Type("array")
     * @SerializedName("meta")
     * @Groups("getOne")
     * @Expose
     */
    private $meta;
    /**
     * @var \DateTime;
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Virtual property
     * @var int
     * @Type("int")
     * @SerializedName("page")
     * @Expose
     */
    private $structureItem;

    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param string $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    public function addItem(ComponentSliderMeta $item)
    {
        $this->items[] = $item;
    }

    public function removeItem(ComponentSliderMeta $item)
    {
        $this->items->removeElement($item);
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * Virtual property
     * @return int
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }




}

