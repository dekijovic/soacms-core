<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/1/2017
 * Time: 12:14 AM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\CmsList;
use CmsBundle\Entity\CmsListType;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\Repository\CmsListRepository;
use CmsBundle\Repository\CmsListTypeRepository;
use CmsBundle\RequestModel\ListItem;
use CmsBundle\RequestModel\ListType;

class ListService
{

    private $listRepo;

    private $listTypeRepo;

    /**
     * ListService constructor.
     * @param CmsListRepository $listRepository
     * @param CmsListTypeRepository $typeRepository
     */
    public function __construct(CmsListRepository $listRepository, CmsListTypeRepository $typeRepository)
    {
        $this->listRepo = $listRepository;
        $this->listTypeRepo = $typeRepository;
    }

    /**
     * @return CmsListType[]
     * @throws NotFoundObjectException
     */
    public function getAllListTypes()
    {
        $records = $this->listTypeRepo->findAll();
        if(count($records) == 0){
            throw new NotFoundObjectException("There is no List Types");
        }
        return $records;
    }

    /**
     * @return CmsList[]
     * @throws NotFoundObjectException
     */
    public function getAllLists()
    {
        $records = $this->listRepo->findAll();
        if(count($records) == 0){
            throw new NotFoundObjectException("There is no List Types");
        }
        return $records;
    }

    /**
     * @param $id
     * @return CmsListType
     * @throws NotFoundObjectException
     */
    public function getListType($id)
    {
        $record = $this->listTypeRepo->find($id);
        if($record == null){
            throw new NotFoundObjectException("List type not found");
        }
        return $record;
    }

    /**
     * @param $id
     * @return CmsList
     * @throws NotFoundObjectException
     */
    public function getList($id)
    {
        $record = $this->listRepo->find($id);
        if($record == null){
            throw new NotFoundObjectException("List type not found");
        }
        return $record;
    }
    /**
     * @param $name
     * @return CmsList
     * @throws NotFoundObjectException
     */
    public function getListByName($name)
    {
        $record = $this->listRepo->findOneBy(["name"=>$name]);
        if($record == null){
            throw new NotFoundObjectException("List type not found");
        }
        return $record;
    }

    /**
     * @param ListItem $item
     * @return CmsList
     */
    public function createList(ListItem $item){

        $entity = new CmsList();
        $entity->setName($item->getName());
        $entity->setType($this->listTypeRepo->find($item->getTypeId()));
        $entity->setItems($item->getItems());
        $entity->setCustomData($item->getCustomData());

        $this->listRepo->save($entity);
        return $entity;
    }

    /**
     * @param ListType $listType
     * @return CmsListType
     */
    public function createListType(ListType $listType)
    {
        $entity = new CmsListType();
        $entity->setType($listType->getName());

        $this->listRepo->save($entity);
        return $entity;
    }

    /**
     * @param ListItem $item
     * @param $id
     * @return CmsList
     */
    public function updateList(ListItem $item, $id)
    {
        $entity = $this->listRepo->find($id);
        $entity->setName($item->getName());
        $entity->setType($this->listTypeRepo->find($item->getTypeId()));
        $entity->setItems($item->getItems());
        $entity->setCustomData($item->getCustomData());

        $this->listRepo->save($entity);
        return $entity;

    }

    /**
     * @param ListType $listType
     * @param $id
     * @return CmsListType
     */
    public function updateListType(ListType $listType, $id)
    {
        $entity = $this->listTypeRepo->find($id);
        $entity->setType($listType->getName());

        $this->listRepo->save($entity);
        return $entity;
    }

    /**
     * @param $id
     * @return void
     * @throws NotFoundObjectException
     */
    public function deleteListType($id)
    {
        $this->getListType($id)->delete();
    }

    /**
     * @param $id
     * @return void
     * @throws NotFoundObjectException
     */
    public function deleteList($id)
    {
        $this->getList($id)->delete();
    }

    /**
     * @param $mainmenu
     * @return CmsList
     */
    public function createMainMenu($mainmenu){
        $entity = $this->listTypeRepo->findOneBy(["type" => "menu"]);
        if(!$entity){
            $entity = new CmsListType();
            $entity->setType("menu");

            $this->listRepo->save($entity);
        }

        $list = $this->listRepo->findOneBy(["name" => "mainmenu"]);

        if(!$list){
            $list = new CmsList();

        }
            $list->setName("mainmenu");
            $list->setType($entity);
            $list->setItems($mainmenu);
            $list->setCustomData([]);


        $this->listRepo->save($list);
        return $list;
    }
    
}