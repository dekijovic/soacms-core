<?php

namespace Modules\EcommerceBundle\Entity;

use CmsBundle\Entity\StructureItem;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Category
 *
 * @ORM\Table(name="ec_categories")
 * @ORM\Entity(repositoryClass="Modules\EcommerceBundle\Repository\EcommerceCategoryRepository")
 * @ExclusionPolicy("all")
 */
class EcommerceCategory
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
     * @ORM\Column(name="title", type="string", length=255)
     * @MaxDepth(1)
     * @Expose
     */
    private $title;

    /**
     * @var StructureItem
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureItem")
     * @ORM\JoinColumn(name="structure_item_id", referencedColumnName="id", nullable=false)
     * @MaxDepth(1)
     * @Expose
     */
    private $structureItem;

    /**
     * @var JsonType
     * @ORM\Column(name="meta", type="json")
     * @MaxDepth(1)
     * @Expose
     */
    private $meta;

    /**
     * @var EcommerceProduct[]
     * @ORM\OneToMany(targetEntity="EcommerceProduct", mappedBy="level")
     */
    private $products;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;


    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return EcommerceCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set structureItem.
     *
     * @param string $structureItem
     *
     * @return EcommerceCategory
     */
    public function setStructureItem($structureItem)
    {
        $this->structureItem = $structureItem;

        return $this;
    }

    /**
     * Get structureItem.
     *
     * @return string
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }

    /**
     * Set deletedAt.
     *
     * @param string $deletedAt
     *
     * @return EcommerceCategory
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return string
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return JsonType
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param JsonType $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @param EcommerceProduct $product
     */
    public function addProduct(EcommerceProduct $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param EcommerceProduct $product
     */
    public function removeProduct(EcommerceProduct $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }


}
