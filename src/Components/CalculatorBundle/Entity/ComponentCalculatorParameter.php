<?php

namespace Components\CalculatorBundle\Entity;

use CmsBundle\Entity\StructureComponent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentCalculatorParameter
 *
 * @ORM\Table(name="component_calculator_parameters")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorParameterRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorParameter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @MaxDepth(1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     * @Expose
     * @MaxDepth(1)
     */
    private $label;

    /**
     * type of input data radio, checkbox, select
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Expose
     * @MaxDepth(1)
     */
    private $type;

    /**
     * @var ComponentCalculatorParamItem[]
     * @ORM\OneToMany(targetEntity="ComponentCalculatorParamItem", mappedBy="parameter", cascade={"ALL"})
     * @Expose
     */
    private $paramItems;

    /**
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorParamItem", inversedBy="subParameter")
     */
    private $parentItem;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    public function __construct()
    {
        $this->paramItems = new ArrayCollection();
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
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return ComponentCalculatorParamItem[]
     */
    public function getParamItems()
    {
        return $this->paramItems;
    }

    /**
     * @param ComponentCalculatorParamItem $paramItem
     */
    public function addParamItems(ComponentCalculatorParamItem $paramItem)
    {
        $this->paramItems[] = $paramItem;
    }

    /**
     * @param ComponentCalculatorParamItem $paramItem
     */
    public function removeParamItems(ComponentCalculatorParamItem $paramItem)
    {
        $this->paramItems->removeElement($paramItem);
    }

    /**
     * @return mixed
     */
    public function getParentItem()
    {
        return $this->parentItem;
    }

    /**
     * @param mixed $parentItem
     */
    public function setParentItem($parentItem)
    {
        $this->parentItem = $parentItem;
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
