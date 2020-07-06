<?php
namespace Components\CalculatorBundle\Transformer;


use Components\CalculatorBundle\Entity\ComponentCalculatorParamCalc;
use Components\CalculatorBundle\Response\Parameter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class CalculatorParameterTransformer
{

    public static function getInstance()
    {
        return new static;
    }

    /**
     * @param Collection $params
     * @param bool $prime
     * @return array
     */
    public function transform(Collection $params, $prime = false)
    {
        $arr = [];
        /** @var ComponentCalculatorParamCalc $param */
        foreach ($params as $param) {
            if($prime){
                if($param->getParentItem() !== null){
                    continue;
                }
            }
            $items = CalculatorItemTransformer::getInstance()->transform($param->getCalcItems());
            $parameter = new Parameter(
                $param->getId(),
                $param->getParameter()->getLabel(),
                $param->getParameter()->getType(),
                $items
            );
            $arr[] = $parameter;
        }

        return $arr;
    }
    
}