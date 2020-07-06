<?php
namespace CmsBundle\ResponseModel;


use CmsBundle\RequestModel\Page;

class Template{

    private $id;

    private $title;
    
    private $url_name;
    
    private $page_locale;

    private $level_id;

    private $level_name;

    private $parent;

    private $components;

    private $component_stack;

    private $img_banner;

    private $color;

    private $pictogram;

    private $pictogram_hover;

    private $pictogram_large_hover;

    private $pictogram_large;

    private $nav_banner;

    private $page_type;

    /**
     * Template constructor.
     * @param $id
     * @param $title
     * @param $url_name
     * @param $page_locale
     * @param $level_id
     * @param $level_name
     * @param null $parent
     * @param $components
     * @param $component_stack
     * @param $imgBanner
     * @param $color
     * @param $pictogram
     * @param $pageType
     * @param $pictogramLarge
     * @param $pictogramLargeHover
     * @param $pictogramHover
     * @param $navBanner
     *
     */
    public function __construct($id,
                                $title,
                                $url_name,
                                $page_locale,
                                $level_id,
                                $level_name,
                                $parent = null,
                                $components,
                                $component_stack,
                                $imgBanner,
                                $color,
                                $pageType,
                                $pictogramLarge,
                                $pictogramLargeHover,
                                $pictogram,
                                $pictogramHover,
                                $navBanner)
    {

        $this->id = $id;
        $this->title = $title;
        $this->url_name = $url_name;
        $this->page_locale = $page_locale;
        $this->level_id = $level_id;
        $this->level_name = $level_name;
        $this->parent = $parent;
        $this->components = $components;
        $this->component_stack = $component_stack;
        $this->img_banner = $imgBanner;
        $this->color = $color;
        $this->pictogram = $pictogram;
        $this->pictogram_large = $pictogramLarge;
        $this->pictogram_large_hover = $pictogramLargeHover;
        $this->pictogram_hover = $pictogramHover;
        $this->nav_banner = $navBanner;
        $this->page_type = $pageType;
    }

}