<?php

namespace Components\CalculatorBundle\Transformer;

use Components\CalculatorBundle\Entity\ComponentCalculatorPrice;
use Components\CalculatorBundle\Entity\ComponentCalculatorRange;
use Components\CalculatorBundle\Response\Price;
use Components\CalculatorBundle\Response\Range;
use Doctrine\Common\Collections\Collection;

class CalculatorRangeTransformer
{
    public static function getInstance()
    {
        return new static;
    }

    public function transfrom(Collection $range)
    {
        $arr = [];
        /** @var ComponentCalculatorRange $item */
        foreach ($range as $item) {

            $prices = $this->prices($item->getPrices());
            $range = new Range($item->getFrom(), $item->getTo(), $prices);
            $arr[] = $range;
        }
        return $arr;
    }

    /**
     * @param ComponentCalculatorPrice[] $prices
     * @return array
     */
    private function prices($prices)
    {
        $arr = [];
        foreach ($prices as $price)
        {
            $item = new Price($price->getKey(), $price->getPrice());
            $arr[] = $item;
        }
        return $arr;
    }

}