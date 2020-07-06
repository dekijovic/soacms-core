<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 4/19/2018
 * Time: 4:09 PM
 */

namespace Components\CalculatorBundle\Response;


class Item
{

    private $id, $item, $parameters;

    public function __construct(
        $id, $item, $parameters
    )
    {
        $this->id = $id;
        $this->item = $item;
        $this->parameters = $parameters;
    }
}