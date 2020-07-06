<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/13/2017
 * Time: 6:29 PM
 */

namespace Components\HomepagePromoPageBundle\RequestModel;


use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class HomepagePromopageMeta
{

    /**
     * @var
     * @Type("string")
     * @SerializedName("title")
     */
    private $title;

    /**
     * @var
     * @Type("string")
     */
    private $content;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("background_color")
     */
    private $backgroundColor;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("image")
     */
    private $image;

    /**
     * @var string
     * @Type("integer")
     * @SerializedName("type")
     */
    private $type;

    /**
     * @var int
     * @Type("integer")
     * @SerializedName("structure_item")
     */
    private $structureItem;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("link")
     */
    private $link;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }



    
}