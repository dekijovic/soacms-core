<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/14/2017
 * Time: 12:37 AM
 */

namespace CmsBundle\Services;

use CmsBundle\Entity\ComponentRegister;
use CmsBundle\Entity\StructureComponent;
use CmsBundle\Repository\ComponentRegisterRepository;
use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Repository\StructureItemRepository;

class RegisterComponentService
{
    /** @var ComponentRegisterRepository  */
    private $componentRegisterRepo;

    /** @var StructureComponentRepository  */
    private $structureComponentRepo;
    
    /** @var StructureItemRepository  */
    private $structureItemRepo;
    /**
     * RegisterComponentService constructor.
     * @param ComponentRegisterRepository $componentRegisterRepository
     * @param StructureComponentRepository $structureComponentRepository
     * @param StructureItemRepository $structureItemRepository
     */
    public function __construct(ComponentRegisterRepository $componentRegisterRepository,
                                StructureComponentRepository $structureComponentRepository,
                                StructureItemRepository $structureItemRepository)
    {
        $this->componentRegisterRepo = $componentRegisterRepository;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->structureItemRepo = $structureItemRepository;
    }

    public function getComponentRegisterByName($name)
    {
        return $this->componentRegisterRepo->getOneByName($name);
    }

    /**
     *  registering component with CMS
     * by adding to componentRegister record
     */
    public function addComponentToRegister($name)
    {
        $register = new ComponentRegister();
        $register->setComponentName($name);
        $this->componentRegisterRepo->save($register);
    }

    /**
     * @param $componentName
     * @param $structureItemId
     * @return StructureComponent
     */
    public function addComponentToStructureItem($componentName, $structureItemId)
    {
        $componentRegister = $this->getComponentRegisterByName($componentName);
        $structureItem = $this->structureItemRepo->find($structureItemId);

        return $this->structureComponentRepo->addComponentToStructureItem($componentRegister, $structureItem);
    }
}