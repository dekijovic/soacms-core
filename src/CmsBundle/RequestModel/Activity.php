<?php

namespace CmsBundle\RequestModel;


use CmsBundle\Exceptions\InvalidParameterException;
use CmsBundle\Registry\Constants;

class Activity extends Page
{

    /**
     * @inherit
     */
    protected $level = Constants::ACTIVITY;

    CONST DEFAULT_COLOR = "default-color";
    const COLORS = [self::DEFAULT_COLOR,
                    "default-color-reklamni-materijal",
                    "default-color-digitalna-stampa",
                    "default-color-zastave",
                    "default-color-proizvodi-promocije",
                    "default-color-klirit",
                    "default-color-XXLstampa"];

    public static function initialize($obj)
    {
        static::validator($obj);
        $component_stack = static ::validateComponentStack($obj);
        $obj->parent_id = null;

        $meta = static::settingMeta($obj);
        
        return new Activity($obj->title,
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
        if(isset($obj->color)){
            if(in_array($obj->color, self::COLORS)){
                $color = $obj->color;
            }else{
                $color = self::DEFAULT_COLOR;
            }
        }else{
            $color = self::DEFAULT_COLOR;
        }

        if(isset($obj->img_banner)){
            $imgBanner = $obj->img_banner;
        }else{
            $imgBanner = null;
        }
        $meta["color"] = $color;
        $meta["imgBanner"] = $imgBanner;
        return $meta;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->meta["color"];
    }

    /**
     * @return string
     */
    public function getImgBanner()
    {
        return $this->meta["imgBanner"];
    }
}