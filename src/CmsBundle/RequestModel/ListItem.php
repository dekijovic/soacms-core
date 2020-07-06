<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/1/2017
 * Time: 1:11 AM
 */

namespace CmsBundle\RequestModel;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class ListItem
{
    /**
     * @var string
     * @Type("string")
     * @SerializedName("name")
     */
    private $name;
    /**
     * @var int
     * @Type("integer")
     * @SerializedName("type_id")
     */
    private $typeId;
    /**
     * @var array
     * @Type("array")
     * @SerializedName("items")
     */
    private $items;

    /**
     * @var array
     * @Type("array")
     * @SerializedName("custom_data")
     */
    private $customData;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    
}