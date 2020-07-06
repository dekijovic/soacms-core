<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/26/2017
 * Time: 3:24 PM
 */

namespace CmsBundle\DataFixtures;


use CmsBundle\Entity\ComponentRegister;
use Components\HomepagePromoPageBundle\Service\HomepagePromopageService;
use Components\HomepageSliderBundle\Service\SliderService;
use Components\ReferencesBundle\Service\ReferenceService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ComponentRegisterFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $component = [
            SliderService::COMPONENT_NAME,
            ReferenceService::COMPONENT_NAME,
            HomepagePromopageService::COMPONENT_NAME
        ];

        foreach ($component as $c) {
            $entity = new ComponentRegister();
            $entity->setComponentName($c);
            $manager->persist($entity);
        }
        $manager->flush();
    }
}