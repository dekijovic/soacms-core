<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/26/2017
 * Time: 3:24 PM
 */

namespace CmsBundle\DataFixtures;


use CmsBundle\Entity\Config;
use CmsBundle\Entity\User;
use CmsBundle\Registry\ConfigSettings;
use CmsBundle\Registry\Constants;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $default = ConfigSettings::SETTINGS;
        $theme = Constants::DEFAULT_THEME_SETTINGS;
        $themeSettings = $theme::SETTINGS;

        foreach ($default as $dKey =>$dValue){
            if (isset($themeSettings[$dKey])){
                unset($default[$dKey]);
            }else{
                $themeSettings[$dKey] = $dValue;
            }
        }
        foreach ($themeSettings as $key => $value){
            $config = new Config();
            $config->setParamKey($key);
            $config->setParamValue($value);
            $manager->persist($config);
        }
        $manager->flush();
    }
}