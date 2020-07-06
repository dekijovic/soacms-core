<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/27/2017
 * Time: 12:08 PM
 */

namespace CmsBundle\RequestModel;


use Symfony\Component\Asset\Exception\InvalidArgumentException;

class Level
{

    /** @var  string */
    private $title;

    /**
     * @param $title
     * @return Level
     */
    public static function initialize($title){

        self::checkTitleLevel($title);
        return new Level($title);
    }

    /**
     * @param $title
     */
    private static function checkTitleLevel($title)
    {
        if($title == "" || !is_string($title)){
            throw new InvalidArgumentException( "Title of structure level is invalid");
        }
    }

    /**
     * Level constructor.
     * @param $title
     */
    private function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

}