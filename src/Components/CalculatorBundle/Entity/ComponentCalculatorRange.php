<?php

namespace Components\CalculatorBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * ComponentCalculatorParamCalc
 *
 * @ORM\Table(name="component_calculator_range")
 * @ORM\Entity(repositoryClass="Components\CalculatorBundle\Repository\ComponentCalculatorRangeRepository")
 * @ExclusionPolicy("all")
 */
class ComponentCalculatorRange
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
     * @ORM\ManyToOne(targetEntity="ComponentCalculatorPrime")
     * @ORM\JoinColumn(name="calculator_id", referencedColumnName="id")
     */
    private $calculator;

    /**
     * @var int
     * @ORM\Column(name="from", type="float")
     * @Expose
     * @MaxDepth(1)
     */
    private $from;

    /**
     * @var int
     * @ORM\Column(name="to", type="float")
     * @Expose
     * @MaxDepth(1)
     */
    private $to;

    /**
     * @var ComponentCalculatorPrice[]
     * @ORM\OneToMany(targetEntity ="ComponentCalculatorPrice", mappedBy="range")
     */
    private $prices;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

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
     * @return int
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param int $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return ComponentCalculatorPrice[]
     */
    public function getPrices()
    {
        return $this->prices;
    }


    /**
     * @param ComponentCalculatorPrice $price
     */
    public function addPrice(ComponentCalculatorPrice $price)
    {
        $this->prices[] = $price;
    }

    /**
     * @param ComponentCalculatorPrice $price
     */
    public function removeRange(ComponentCalculatorPrice $price)
    {
        $this->prices->removeElement($price);
    }
}