<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/1/2017
 * Time: 12:32 AM
 */

namespace CmsBundle\RequestModel;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class ListType
{

    /**
     * @var string
     * @Type("string")
     * @SerializedName("name")
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}