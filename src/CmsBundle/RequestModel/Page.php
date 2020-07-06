<?php

namespace CmsBundle\RequestModel;

use CmsBundle\Exceptions\InvalidParameterException;
use CmsBundle\Registry\Constants;
use JMS\Serializer\Annotation as Serializer;
/**
 * Class Page
 * Page Value object
 * @package CmsBundle\Model
 */
class Page
{
    const REGULAR_PAGE_TYPE = "regular-page";
    const CATEGORY_PAGE_TYPE = "category-page";
    const PAGE_TYPE = "page";
    const PAGE_TYPES = [self::CATEGORY_PAGE_TYPE, self::REGULAR_PAGE_TYPE, self::PAGE_TYPE];
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    protected $urlName;

    /**
     * @var int
     */
    protected $createdUserId;

    /**
     * @var boolean
     */
    protected $deletedAt;

    /**
     * @var PageLocale[]
     */
    protected $pageLocale;

    /**
     * @var int
     */
    protected $level = Constants::PAGE;

    /**
     * @var array
     */
    protected $componentStack;
    /**
     * @var string
     */
    protected $pageType;

    /**
     * @var array
     */
    protected $meta =[];

    /**
     * @var
     */
    protected $parentStructureId;

    /**
     * Initialize making Value Object Page
     * @param Obj
     * @return Page
     * @throws InvalidParameterException
     */
    public static function initialize($obj)
    {
        static::validator($obj);
        $component_stack = static ::validateComponentStack($obj);
        $meta = self::settingMeta($obj);

        return new Page($obj->title,
                        $obj->user_id,
                        $obj->parent_id,
                        $obj->page_locale,
                        $component_stack,
                        $obj->url_name,
                        $meta);
    }

    /**
     * @param $obj
     * @throws InvalidParameterException
     */
    public static function validator($obj)
    {
        if($obj->title == ""){
            throw new InvalidParameterException(" Title not acceptable");
        }
        if($obj->url_name == ""){
            throw new InvalidParameterException(" UrlName not acceptable");
        }
        if(!isset($obj->parent_id) || $obj->parent_id == ""){
            throw new InvalidParameterException(" There must be Parent category");
        }
    }

    /**
     * @param $obj
     * @return array
     */
    public static function validateComponentStack($obj)
    {
        if(!isset($obj->component_stack)){
            return NULL;
        }
        return $obj->component_stack;
    }

    /**
     * @param $obj
     * @return string
     */
    public static function settingMeta($obj)
    {
        if(isset($obj->page_type)){
            if(in_array($obj->page_type, self::PAGE_TYPES)) {
                $pageType = $obj->page_type;
            }else{
                $pageType = "page";
            }
        }else{
            $pageType = "page";
        }
        return $meta["pageType"] = $pageType;
    }

    /**
     * Page constructor.
     * @param $title
     * @param $createdUserId
     * @param $parentStructureId
     * @param $pageLocale
     * @param $componentStack
     * @param $urlName
     * @param $meta
     * @param $deletedAt
     */
    protected function __construct($title,
                                 $createdUserId, 
                                 $parentStructureId,
                                 $pageLocale,
                                 $componentStack,
                                 $urlName,
                                 $meta,
                                 $deletedAt = false)
    {
        $this->title = $title;
        $this->parentStructureId = $parentStructureId;
        $this->createdUserId = $createdUserId;
        $this->deletedAt = $deletedAt;
        $this->pageLocale = $pageLocale;
        $this->urlName = $urlName;
        $this->componentStack = $componentStack;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * @return int
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @return bool
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return PageLocale[]
     */
    public function getPageLocale()
    {
        return $this->pageLocale;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return array
     */
    public function getComponentStack()
    {
        return $this->componentStack;
    }

    /**
     * @return mixed
     */
    public function getParentStructureId()
    {
        return $this->parentStructureId;
    }

    /**
     * @return string
     */
    public function getPageType()
    {
        return $this->pageType;

    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }


}