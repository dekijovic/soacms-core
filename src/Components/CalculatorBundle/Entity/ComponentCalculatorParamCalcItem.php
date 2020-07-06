<?php

namespace Components\CalculatorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * ComponentCalculatorParamCalcItem
 *
 * @ORM\Table(name="component_calculator_param_calc_items")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorParamCalcItemRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorParamCalcItem
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
     * @var ComponentCalculatorParamCalc
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorParamCalc")
     * @ORM\JoinColumn(name="param_calc_id", referencedColumnName="id")
     */
    private $paramCalc;

    /**
     * @var ComponentCalculatorParamItem
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorParamItem")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * @Expose
     */
    private $item;

    /**
     * @var ComponentCalculatorParamCalc[]
     * @ORM\OneToMany(targetEntity ="ComponentCalculatorParamCalc", mappedBy="parentItem")
     */
    private $subParams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subParams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ComponentCalculatorParamItem
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param ComponentCalculatorParamItem $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return ComponentCalculatorParamCalc
     */
    public function getParamCalc()
    {
        return $this->paramCalc;
    }

    /**
     * @param ComponentCalculatorParamCalc $paramCalc
     */
    public function setParamCalc($paramCalc)
    {
        $this->paramCalc = $paramCalc;
    }

    /**
     * @return ComponentCalculatorParamCalc[]
     */
    public function getSubParams()
    {
        return $this->subParams;
    }

    /**
     * @param ComponentCalculatorParamCalc $subParam
     */
    public function addSubParams(ComponentCalculatorParamCalc $subParam)
    {
        $this->subParams[] = $subParam;
    }

    /**
     * @param ComponentCalculatorParamCalc $subParam
     */
    public function removeSubParams(ComponentCalculatorParamCalc $subParam)
    {
        $this->subParams->removeElement($subParam);
    }


}