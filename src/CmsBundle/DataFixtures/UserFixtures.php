<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/26/2017
 * Time: 3:24 PM
 */

namespace CmsBundle\DataFixtures;


use CmsBundle\Entity\User;
use CmsBundle\Repository\StructureItemRepository;
use CmsBundle\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("admin");
        $user->setFullName("admin");
        $user->setEmail("dejanjovic10@gmail.com");
        $manager->persist($user);
        $manager->flush();
    }
}