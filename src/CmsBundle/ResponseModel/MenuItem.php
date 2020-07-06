<?php

namespace CmsBundle\ResponseModel;


class MenuItem
{

    protected $id;

    protected $title;

    protected $urlName;

    protected $level;
    
    protected $sub;

    protected $pictogramNav;

    protected $pictogramNavHover;

    protected $pictogramLarge;

    protected $pictogramLargeHover;

    protected $color;

    protected $imgBanner;

    protected $pageType;

    public function __construct($id,
                                $title,
                                $urlName,
                                $level,
                                $sub,
                                $pictogramNav,
                                $pictogramNavHover,
                                $pictogramLarge,
                                $pictogramLargeHover,
                                $color,
                                $imgBanner,
                                $pageType)
    {
        $this->id = $id;
        $this->title = $title;
        $this->urlName = $urlName;
        $this->level = $level;
        $this->sub = $sub;
        $this->pictogramNav = $pictogramNav;
        $this->pictogramNavHover = $pictogramNavHover;
        $this->pictogramLarge = $pictogramLarge;
        $this->pictogramLargeHover = $pictogramLargeHover;
        $this->color = $color;
        $this->imgBanner = $imgBanner;
        $this->pageType = $pageType;
    }
}