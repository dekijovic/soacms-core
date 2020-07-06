<?php

namespace Modules\EcommerceBundle\Entity;

use CmsBundle\Entity\StructureItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="ec_products")
 * @ORM\Entity(repositoryClass="Modules\EcommerceBundle\Repository\EcommerceProductRepository")
 */
class EcommerceProduct
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
     * @var
     * @ORM\Column(name="product_number", type="string")
     */
    private $productNumber;
    /**
     * @var StructureItem
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureItem")
     * @ORM\JoinColumn(name="structure_item_id", referencedColumnName="id", nullable=false)
     */
    private $structureItem;

    /**
     * @var EcommerceCategory
     * @ORM\ManyToOne(targetEntity="EcommerceCategory", inversedBy="product")
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var EcommerceProductImage[]
     * @ORM\OneToMany(targetEntity="EcommerceProductImage", mappedBy="product")
     */
    private $productImages;

    /**
     * @var bool
     *
     * @ORM\Column(name="exclude", type="boolean")
     */
    private $exclude;

    /**
     * @var \DateTime
     * @ORM\Column(name="deleted_at", type="datetime")
     */
    private $deletedAt;

    /**
     * @var
     *@ORM\Column(name="meta", type="json", nullable=true)
     *
     */
    private $meta;

    /**
     * @var EcommerceAttribute[]
     * @ORM\ManyToMany(targetEntity="EcommerceAttribute", inversedBy="products")
     * @ORM\JoinTable(name="ec_products_attributes")
     */
    private $attributes;

    public function __construct()
    {
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productImages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProductNumber()
    {
        return $this->productNumber;
    }

    /**
     * @param mixed $productNumber
     */
    public function setProductNumber($productNumber)
    {
        $this->productNumber = $productNumber;
    }

    /**
     * @return StructureItem
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }

    /**
     * @param StructureItem $structureItem
     */
    public function setStructureItem($structureItem)
    {
        $this->structureItem = $structureItem;
    }

    /**
     * @return EcommerceCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param EcommerceCategory $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return boolean
     */
    public function isExclude()
    {
        return $this->exclude;
    }

    /**
     * @param boolean $exclude
     */
    public function setExclude($exclude)
    {
        $this->exclude = $exclude;
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
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return EcommerceProductImage[]
     */
    public function getProductImages()
    {
        return $this->productImages;
    }

    /**
     * @param EcommerceProductImage[] $productImages
     */
    public function setProductImages($productImages)
    {
        $this->productImages = $productImages;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

}
