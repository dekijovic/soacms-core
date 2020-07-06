<?php
namespace Components\CalculatorBundle\Response;


class CalculatorPrime
{

    private $id;

    private $title;

    private $note, $pdv, $rsd, $unit, $unitNote,$quantityCalculationType, $dimensionMeasure, $parameters, $priceTable;

    public function __construct($id, $name, $note, $pdv, $rsd, $unit, $unitNote,$quantityCalculationType, $dimensionMeasure, $parameters, $priceTable)
    {
        $this->id = $id;
        $this->title = $name;
        $this->pdv = $pdv;
        $this->rsd = $rsd;
        $this->unit = $unit;
        $this->note = $note;
        $this->unitNote = $unitNote;
        $this->quantityCalculationType = $quantityCalculationType;
        $this->dimensionMeasure = $dimensionMeasure;
        $this->parameters = $parameters;
        $this->priceTable = $priceTable;
    }
}