<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 4/19/2018
 * Time: 10:41 PM
 */

namespace Components\CalculatorBundle\Response;


class Range
{

    private $from, $to, $prices;
    
    public function __construct($from, $to, $prices)
    {
        $this->from = $from;
        $this->to = $to;
        $this->prices = $prices;
    }
}