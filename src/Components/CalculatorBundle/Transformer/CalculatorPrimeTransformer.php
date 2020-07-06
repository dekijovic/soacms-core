<?php

namespace Components\CalculatorBundle\Transformer;

use Components\CalculatorBundle\Entity\ComponentCalculatorPrime;
use Components\CalculatorBundle\Response\CalculatorPrime;
use Components\CalculatorBundle\Service\CurrencyService;

class CalculatorPrimeTransformer
{
    public static function getInstance()
    {
        return new static;
    }

    public function transfrom(ComponentCalculatorPrime $calculatorPrime, CurrencyService $currency = null)
    {
        $parameters = CalculatorParameterTransformer::getInstance()->transform($calculatorPrime->getCalcParams(), true);
        $priceTable = CalculatorRangeTransformer::getInstance()->transfrom($calculatorPrime->getRange());


        $rCalculator = new CalculatorPrime(
            $calculatorPrime->getId(),
            $calculatorPrime->getName(),
            $calculatorPrime->getNote(),
            $calculatorPrime->getPdv(),
            $currency->getCurrencyValue(),
            $calculatorPrime->getUnit(),
            $calculatorPrime->getUnitNote(),
            $calculatorPrime->getQuantityCalculationType(),
            $calculatorPrime->getDimensionMeasure(),
            $parameters,
            $priceTable
        );
        return $rCalculator;
    }
}