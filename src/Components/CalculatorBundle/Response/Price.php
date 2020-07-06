<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 4/19/2018
 * Time: 10:42 PM
 */

namespace Components\CalculatorBundle\Response;


class Price
{

    private $index, $price;
    
    public function __construct($index, $price)
    {
        $this->index = $index;
        $this->price = $price;
    }
}