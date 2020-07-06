<?php

namespace Components\CalculatorBundle\Entity;

use CmsBundle\Entity\StructureComponent;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentCalculatorPrice
 *
 * @ORM\Table(name="component_calculator_price")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorPriceRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorPrice
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
     * @var ComponentCalculatorPrime
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorPrime")
     * @ORM\JoinColumn(name="calculator_id", referencedColumnName="id")
     */
    private $calculator;
    /**
     * @var array
     *
     * @ORM\Column(name="name", type="json", nullable=false)
     */
    private $key = [];

    /**
     * @var ComponentCalculatorPrime
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorRange")
     * @ORM\JoinColumn(name="range_id", referencedColumnName="id")
     */
    private $range;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal" , precision=10, scale=2)
     */
    private $price;


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
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return ComponentCalculatorPrime
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param ComponentCalculatorPrime $range
     */
    public function setRange($range)
    {
        $this->range = $range;
    }


}
