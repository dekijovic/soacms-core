<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/27/2017
 * Time: 12:08 PM
 */

namespace CmsBundle\RequestModel;


use Symfony\Component\Asset\Exception\InvalidArgumentException;

class Language
{

    /** @var  string */
    private $name;

    /** @var  string */
    private $prefix;

    /** @var   */
    private $icon;
    /**
     * @param $name
     * @param $prefix
     * @param $icon
     * @return Language
     */
    public static function initialize($name, $prefix, $icon){

        self::checkNameLevel($name);
        return new Language($name, $prefix, $icon);
    }

    /**
     * @param $title
     */
    private static function checkNameLevel($title)
    {
        if($title == "" || !is_string($title)){
            throw new InvalidArgumentException( "Title of structure level is invalid");
        }
    }

    /**
     * Language constructor.
     * @param $name
     * @param $prefix
     * @param $icon
     */
    private function __construct($name, $prefix, $icon)
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }
}