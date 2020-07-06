<?php

namespace Components\CalculatorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * ComponentCalculatorParamCalc
 *
 * @ORM\Table(name="component_calculator_param_calc")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorParamCalcRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorParamCalc
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
     * @var ComponentCalculatorPrime
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorPrime", inversedBy="calcParams")
     * @ORM\JoinColumn(name="calculator_id", referencedColumnName="id")
     */
    private $calculator;

    /**
     * @var ComponentCalculatorParameter
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorParameter")
     * @ORM\JoinColumn(name="parameter_id", referencedColumnName="id")
     * @Expose
     */
    private $parameter;

    /**
     * @var ComponentCalculatorParamCalcItem
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorParamCalcItem")
     * @ORM\JoinColumn(name="param_calc_item_id", referencedColumnName="id")
     * @Expose
     */
    private $parentItem;

    /**
     * @var ComponentCalculatorParamCalcItem[]
     * @ORM\OneToMany(targetEntity ="ComponentCalculatorParamCalcItem", mappedBy="paramCalc")
     */
    private $calcItems;
    

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ComponentCalculatorPrime
     */
    public function getCalculator()
    {
        return $this->calculator;
    }

    /**
     * @param ComponentCalculatorPrime $calculator
     */
    public function setCalculator($calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @return ComponentCalculatorParameter
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param ComponentCalculatorParameter $parameter
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * @return ComponentCalculatorParamCalcItem
     */
    public function getParentItem()
    {
        return $this->parentItem;
    }

    /**
     * @param ComponentCalculatorParamCalcItem $parentItem
     */
    public function setParentItem($parentItem)
    {
        $this->parentItem = $parentItem;
    }

    /**
     * @return ComponentCalculatorParamCalcItem[]
     */
    public function getCalcItems()
    {
        return $this->calcItems;
    }
    
    
}