<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 4/19/2018
 * Time: 4:08 PM
 */

namespace Components\CalculatorBundle\Transformer;


use Components\CalculatorBundle\Entity\ComponentCalculatorParamCalcItem;
use Components\CalculatorBundle\Response\Item;
use Doctrine\Common\Collections\Collection;

class CalculatorItemTransformer
{

    public static function getInstance()
    {
        return new static;
    }
    
    public function transform(Collection $items)
    {
        $arr = [];
        /** @var ComponentCalculatorParamCalcItem $item */
        foreach ($items as $item){
            
            $params = CalculatorParameterTransformer::getInstance()->transform($item->getSubParams());
            if($params == []){
                $params = null;
            }
            $item = new Item(
                $item->getId(),
                $item->getItem()->getItem(),
                $params
            );

            $arr[] = $item;
        }

        return $arr;
    }
}