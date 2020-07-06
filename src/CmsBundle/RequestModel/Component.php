<?php

namespace CmsBundle\RequestModel;


class Component
{

    private $id;

    private $register_id;

    private $name;

    private $mobile;

    private $layout;

    /**
     * @param $id
     * @param $register_id
     * @param $name
     * @param $mobile
     * @param $layout
     * @return Component
     */
    static public function initialize($id, $register_id, $name, $mobile, $layout)
    {
        return new self($id, $register_id, $name, $mobile, $layout);
    }

    /**
     * Component constructor.
     * @param $id           component id
     * @param $register_id  component register id
     * @param $name         unique name of component
     * @param $mobile       if mobile
     * @param $layout       layout for frontend
     */
    private function __construct($id, $register_id, $name, $mobile, $layout)
    {
        $this->id = $id;
        $this->register_id = $register_id;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->layout = $layout;
    }
}