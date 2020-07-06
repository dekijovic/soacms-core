<?php

namespace CmsBundle\ResponseModel;


class MainMenuItem extends MenuItem
{
    private $pictogram;

    private $categoryBanner;

    private $color;

    public function __construct($id, $title, $urlName, $level, $sub = [], $color = null, $pictogram = null, $categoryBanner = null)
    {
        parent::__construct($id, $title, $urlName, $level, $sub = []);

        $this->color = $color;
        $this->pictogram = $pictogram;
        $this->categoryBanner = $categoryBanner;
    }
}