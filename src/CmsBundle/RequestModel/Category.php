<?php

namespace CmsBundle\RequestModel;


use CmsBundle\Exceptions\InvalidParameterException;
use CmsBundle\Registry\Constants;

class Category extends Page
{

    /**
     * @inherit
     */
    protected $level = Constants::CATEGORY;

    public static function initialize($obj)
    {
        static::validator($obj);
        $component_stack = static ::validateComponentStack($obj);
        if($obj->parent_id == ""){
            throw new InvalidParameterException(" There must be Parent Activity");
        }
        $meta = static::settingMeta($obj);

        return new Category($obj->title,
                            $obj->user_id,
                            $obj->parent_id,
                            $obj->page_locale,
                            $component_stack,
                            $obj->url_name,
                            $meta);
    }

    /**
     * @param $obj
     * @return array
     */
    public static function settingMeta($obj)
    {
        $meta = [];
        if(isset($obj->large_pictogram)){
            $largePictogram = $obj->large_pictogram;
        }else{
            $largePictogram = null;
        }
        $meta["largePictogram"] = $largePictogram;
        /** ------------------------- */
        if(isset($obj->large_pictogram_hover)){
            $largePictogramHover = $obj->large_pictogram_hover;
        }else{
            $largePictogramHover = null;
        }
        $meta["largePictogramHover"] = $largePictogramHover;
        /** ------------------------- */
        if(isset($obj->pictogram)){
            $pictogram = $obj->pictogram;
        }else{
            $pictogram = null;
        }
        $meta["pictogram"] = $pictogram;
        /** ------------------------- */
        if(isset($obj->pictogram_hover)){
            $pictogramHover = $obj->pictogram_hover;
        }else{
            $pictogramHover = null;
        }
        $meta["pictogramHover"] = $pictogramHover;
        /** ------------------------- */
        if(isset($obj->nav_banner)){
            $navBanner = $obj->nav_banner;
        }else{
            $navBanner = null;
        }
        $meta["navBanner"] = $navBanner;


        return $meta;
    }

    /**
     * @return mixed
     */
    public function getPictogram()
    {
        return $this->meta["pictogram"];
    }
}