<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/26/2017
 * Time: 3:04 PM
 */

namespace CmsBundle\DataFixtures;


use CmsBundle\Entity\StructureItem;
use CmsBundle\Entity\StructureLocale;
use CmsBundle\Registry\Constants;
use CmsBundle\Repository\LanguageRepository;
use CmsBundle\Repository\StructureLevelRepository;
use CmsBundle\Repository\UserRepository;
use Components\HomepageSliderBundle\Service\SliderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StructureItemFixtures extends Fixture implements DependentFixtureInterface, ContainerAwareInterface
{

    private $container;

    private $manager;

    private $user;

    private $activity;

    private $category;

    private $page;

    private $product;

    private $sr;

    private $en;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->user = $this->container->get("cms.user.repository")->findOneBy(["username" => "admin"]);
        $levels = $this->container->get("cms.structure_level.repository")->getLevels();
        $langs = $this->container->get("cms.language.repository")->findAll();

        foreach ($langs as $lang){
            switch ($lang->getPrefix()) {
                case "sr":
                    $this->sr = $lang;
                    break;
                case "en":
                    $this->en = $lang;
            }
        }

        $this->activity = $levels[Constants::ACTIVITY];
        $this->page = $levels[Constants::PAGE];
        $this->category = $levels[Constants::CATEGORY];

        $items=[
            ['title'=>"O Nama", "urlName"=>"/o-nama", "user"=>$this->user, "level"=> $this->page, "content"=> "Nesto o nama"],
            ['title'=>"Kontakt", "urlName"=>"/kontakt", "user"=>$this->user, "level"=> $this->page, "content"=> "Kontakt"],
            ['title'=>"Materijali", "urlName"=>"/materijali", "user"=>$this->user, "level"=> $this->page, "content"=> "Materijali u swa timu"],
            ['title'=>"Karijera", "urlName"=>"/karijera", "user"=>$this->user, "level"=> $this->page, "content"=> "Karijera u swa timu"],
            ['title'=>"Digitalna Stampa",
                "urlName"=>"/digitalna-stampa",
                "user"=>$this->user,
                "level"=> $this->activity,
                 "content"=> "Digitalna stampa ",
                "sub"=> ['title'=>"Brendiranje ",
                    "urlName"=>"/brendiranje",
                    "user"=>$this->user,
                    "level"=> $this->category,
                     "content"=> "Nesto o brendiranju",
                    "sub"=> ['title'=>"Autografika ", "urlName"=>"/autografika", "user"=>$this->user, "level"=> $this->page , "content"=> "Autografika tehnologija "]]],
            ['title'=>"Reklamni Materijal", "urlName"=>"/reklamni-materijal", "user"=>$this->user, "level"=> $this->activity, "content"=> "Reklamni Materijal"],
            ['title'=>"Promocije", "urlName"=>"/promocije", "user"=>$this->user, "level"=> $this->activity, "content"=> "Promocije"],
            ['title'=>"Zastave", "urlName"=>"/zastave", "user"=>$this->user, "level"=> $this->activity, "content"=> "Zastave"],
            ['title'=>"klirit", "urlName"=>"/klirit", "user"=>$this->user, "level"=> $this->activity, "content"=> "klirit"],
            ['title'=>"Offset Stampa", "urlName"=>"/offset-stampa", "user"=>$this->user, "level"=> $this->activity, "content"=> "Offset Stampa"]
        ];

        $homepage = new StructureItem();
        $homepage->setTitle("Pocetna");
        $homepage->setUrlName(Constants::HOMEPAGE_URL);
        $homepage->setCreatorUser($this->user);
        $homepage->setCreatedAt(New \DateTime());
        $homepage->setModifiedAt(New \DateTime());
        $homepage->setLevel($this->activity);
        $homepage->setParentStructure(NULL);
        $this->manager->persist($homepage);
        $this->manager->flush();

        $locale = new StructureLocale();
        $locale->setLanguage($this->sr);
        $locale->setStructureItem($homepage);
        $locale->setContent("");
        $locale->setTitle("PromoImage");
        $locale->setSeoTitle("Promoimage");
        $locale->setSeoDescription("Promoimage");
        $locale->setSeoKeywords("Promoimage");
        $this->manager->persist($locale);
        $this->manager->flush();
        
            

        foreach ($items as $item) {
            $this->setEntity($item, $homepage);

        $manager->flush();
            }
    }
    
    public function getDependencies()
    {
        return[
            UserFixtures::class,
            StructureLevelFixtures::class,
            ComponentRegisterFixtures::class,
            LanguageFixtures::class,
            
        ];
    }

    public function setEntity($item, $parent){
        $entity = new StructureItem();
        $entity->setTitle($item["title"]);
        $entity->setUrlName($item["urlName"]);
        $entity->setCreatorUser($this->user);
        $entity->setCreatedAt(New \DateTime());
        $entity->setModifiedAt(New \DateTime());
        $entity->setLevel($this->activity);
        $entity->setParentStructure($parent);
        $this->manager->persist($entity);
        $this->manager->flush();
        
        $locale = new StructureLocale();
        $locale->setLanguage($this->sr);
        $locale->setStructureItem($entity);
        $locale->setTitle($item["title"]);
        $locale->setContent($item["content"]);
        $locale->setSeoTitle($item["title"]);
        $locale->setSeoDescription($item["title"]);
        $locale->setSeoKeywords($item["title"]);
        $this->manager->persist($locale);
        $this->manager->flush();

        if(isset($item["sub"])){
            $this->setEntity($item["sub"], $entity);
        }

        return $entity;
    }
}