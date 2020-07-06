<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/22/2017
 * Time: 10:53 PM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\Config;
use CmsBundle\Registry\ConfigSettings;
use CmsBundle\Registry\Constants;
use CmsBundle\Repository\ConfigRepository;

class ConfigService
{
    /** @var ConfigRepository  */
    var $repo;
    /**
     * ConfigService constructor.
     * @param ConfigRepository $config
     */
    public function __construct( ConfigRepository $config)
    {
        $this->repo = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $results = $this->repo->findAll();
        return $results;
    }

    /**
     * @param $key
     * @return null|string
     */
    public function getConfigValueByKey($key)
    {
        return $this->repo->findByKey($key);
    }

    /**
     * @param $key
     * @return Config|null
     */
    public function getConfigByKey($key)
    {
        return $this->repo->findConfigByKey($key);
    }

    /**
     * @param $key
     * @param $value
     * @return Config|null
     */
    public function updateConfigByKey($key, $value)
    {
        $config =$this->repo->findConfigByKey($key);
        $config->setParamValue($value);
        $this->repo->save($config);

        return $config;
    }



    /**
     * @return null|object
     */
    public function requiredComponents()
    {

        $record = $this->repo->find(["key"=>"required_components"]);

        return $record;
    }

    /**
     *
     */
    public function setConfig()
    {
        $config = $this->getConfig();
        $default = ConfigSettings::SETTINGS;
        $theme = Constants::DEFAULT_THEME_SETTINGS;
        $themeSettings = $theme::SETTINGS;

        $updateList = [];

        foreach ($default as $dKey =>$dValue){
            if (isset($themeSettings[$dKey])){
                unset($default[$dKey]);
            }else{
                $themeSettings[$dKey] = $dValue;
            }
        }
        if(count($config)>0) {
            foreach ($config as $c) {
                if (isset($themeSettings[$c->getParamKey()])) {
                    $updateList[] = [
                        "id" => $c->getId(),
                        "key" => $c->getParamKey(),
                        "value" => $themeSettings[$c->getParamKey()]
                    ];

                    unset($themeSettings[$c->getParamKey()]);
                }
            }
        }

        foreach ($updateList as $ul){
            $this->updateConfigRow($ul["id"],$ul["key"], $ul["value"]);
        }
        foreach ($themeSettings as $key=>$val){
            $this->insertConfigRow($key, $val);
        }
    }

    public function setNewConfigValue($key, $value)
    {
        $this->insertConfigRow($key, $value);
    }


    /**
     * @param $key
     * @param $value
     */
    private function insertConfigRow($key, $value)
    {
        $config = new Config();
        $config->setParamKey($key);
        $config->setParamValue($value);
        $this->repo->save($config);
    }

    /**
     * @param $id
     * @param $key
     * @param $value
     */
    private function updateConfigRow($id, $key, $value)
    {
        $config =$this->repo->find($id);
        $config->setParamValue($value);
        $this->repo->save($config);
    }
}