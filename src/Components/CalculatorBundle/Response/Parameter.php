<?php

namespace Components\CalculatorBundle\Response;


class Parameter
{

    private $id, $label, $type, $items;
    public function __construct($id, $label, $type, $items)
    {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
        $this->items = $items;
    }
}