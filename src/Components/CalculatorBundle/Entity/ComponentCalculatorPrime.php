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
 * ComponentCalculatorPrime
 *
 * @ORM\Table(name="component_calculator_prime")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorPrimeRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorPrime
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255)
     * @Expose
     */
    private $note;
    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255)
     * @Expose
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_note", type="string", length=255)
     * @Expose
     */
    private $unitNote;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity_calculation_type", type="integer")
     * @Expose
     */
    private $quantityCalculationType;

    /**
     * @var string
     *
     * @ORM\Column(name="dimension_measure", type="string")
     * @Expose
     */
    private $dimensionMeasure;

    /**
     * @var string
     *
     * @ORM\Column(name="pdv", type="integer")
     * @Expose
     */
    private $pdv;

    /**
     * @var StructureComponent
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureComponent")
     * @MaxDepth(1)
     * @Expose
     */
    private $structureComponent;

    /**
     * @var ComponentCalculatorParamCalc[]
     * @ORM\OneToMany(targetEntity ="ComponentCalculatorParamCalc", mappedBy="calculator")
     * @MaxDepth(4)
     * @Expose
     */
    private $calcParams;

    /**
     * @var ComponentCalculatorRange[]
     * @ORM\OneToMany(targetEntity ="ComponentCalculatorRange", mappedBy="calculator")
     */
    private $range;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    public function __construct()
    {
        $this->calcParams = new ArrayCollection();
        $this->range = new ArrayCollection();
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
     * @return ComponentCalculatorPrime
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set structureComponent.
     *
     * @param int $structureComponent
     *
     * @return ComponentCalculatorPrime
     */
    public function setStructureComponent($structureComponent)
    {
        $this->structureComponent = $structureComponent;

        return $this;
    }

    /**
     * Get structureComponent.
     *
     * @return int
     */
    public function getStructureComponent()
    {
        return $this->structureComponent;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return ComponentCalculatorPrime
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getUnitNote()
    {
        return $this->unitNote;
    }

    /**
     * @param string $unitNote
     */
    public function setUnitNote($unitNote)
    {
        $this->unitNote = $unitNote;
    }

    /**
     * @return string
     */
    public function getPdv()
    {
        return $this->pdv;
    }

    /**
     * @param string $pdv
     */
    public function setPdv($pdv)
    {
        $this->pdv = $pdv;
    }

    /**
     * @return ComponentCalculatorParamCalc[]
     */
    public function getCalcParams()
    {
        return $this->calcParams;
    }


    /**
     * @param ComponentCalculatorParamCalc $calcParam
     */
    public function addCalcParams(ComponentCalculatorParamCalc $calcParam)
    {
        $this->calcParams[] = $calcParam;
    }

    /**
     * @param ComponentCalculatorParamCalc $calcParam
     */
    public function removeSubParams(ComponentCalculatorParamCalc $calcParam)
    {
        $this->calcParams->removeElement($calcParam);
    }

    /**
     * @return ComponentCalculatorRange[]
     */
    public function getRange()
    {
        return $this->range;
    }


    /**
     * @param ComponentCalculatorRange $range
     */
    public function addRange(ComponentCalculatorRange $range)
    {
        $this->range[] = $range;
    }

    /**
     * @param ComponentCalculatorRange $range
     */
    public function removeRange(ComponentCalculatorRange $range)
    {
        $this->range->removeElement($range);
    }

    /**
     * @return int
     */
    public function getQuantityCalculationType()
    {
        return $this->quantityCalculationType;
    }

    /**
     * @param int $quantityCalculationType
     */
    public function setQuantityCalculationType($quantityCalculationType)
    {
        $this->quantityCalculationType = $quantityCalculationType;
    }

    /**
     * @return string
     */
    public function getDimensionMeasure()
    {
        return $this->dimensionMeasure;
    }

    /**
     * @param string $dimensionMeasure
     */
    public function setDimensionMeasure($dimensionMeasure)
    {
        $this->dimensionMeasure = $dimensionMeasure;
    }

}
