<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/26/2017
 * Time: 3:24 PM
 */

namespace CmsBundle\DataFixtures;


use CmsBundle\Entity\StructureLevel;
use CmsBundle\Entity\User;
use CmsBundle\Registry\Constants;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StructureLevelFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $level = [Constants::ACTIVITY, Constants::CATEGORY, Constants::PAGE, Constants::PRODUCT];
        foreach ($level as $l) {
            $entity = new StructureLevel();
            $entity->setTitle($l);
            $manager->persist($entity);
        }
        $manager->flush();
    }
}