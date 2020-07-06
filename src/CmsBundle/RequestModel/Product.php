<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 8/9/2017
 * Time: 12:27 PM
 */

namespace CmsBundle\RequestModel;


use CmsBundle\Exceptions\InvalidParameterException;
use CmsBundle\Registry\Constants;

class Product extends Page
{

    /**
     * @inherit
     */
    protected $levelId = Constants::PRODUCT;

    public static function initialize($obj)
    {
        static::validator($obj);
        $component_stack = static ::validateComponentStack($obj);
        if($obj->parent_id == ""){
            throw new InvalidParameterException(" There must be Parent page");
        }
        $meta = null;

        return new Product($obj->title,
                            $obj->user_id,
                            $obj->parent_id,
                            $obj->page_locale,
                            $component_stack,
                            $obj->url_name,
                            $meta);
    }

    protected function __construct($title,
                                 $createdUserId,
                                 $parentStructureId,
                                 $pageLocale,
                                 $componentStack,
                                 $urlName,
                                 $meta,
                                 $deletedAt = null)
    {
        parent::__construct($title,
                            $createdUserId,
                            $parentStructureId,
                            $pageLocale,
                            $componentStack,
                            $urlName,
                            $meta,
                            $deletedAt);
    }
}