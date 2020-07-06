<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/27/2017
 * Time: 11:59 AM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\StructureLevel;
use CmsBundle\Exceptions\FoundObjectException;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\RequestModel\Level;
use CmsBundle\Repository\StructureLevelRepository;

class StructureLevelService
{

    /**
     * @var StructureLevelRepository
     */
    private $repo;

    /**
     * StructureLevelService constructor.
     * @param StructureLevelRepository $repository
     */
    public function __construct(StructureLevelRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @return StructureLevel[]
     */
    public function getAll()
    {
        return $this->repo->findAllRecords();
    }

    /**
     * @param $id
     * @return StructureLevel
     * @throws NotFoundObjectException
     */
    public function getOne($id)
    {
        $record = $this->repo->findRecord($id);

        if($record == null){
            throw new NotFoundObjectException("StructureLevel not found");
        }
        return $record;
    }

    /**
     * @param Level $level
     * @return StructureLevel
     */
    public function create(Level $level)
    {
        $this->checkTitleLevel($level->getTitle());

        $entity = new StructureLevel();
        $entity->setTitle($level->getTitle());
        $this->repo->save($entity);
        return $entity;
    }

    /**
     * @param Level $level
     * @param $id
     * @return StructureLevel
     * @throws NotFoundObjectException
     */
    public function update(Level $level, $id)
    {
        $entity = $this->getOne($id);
        $this->checkTitleLevelExceptThisId($level->getTitle(), $id);
        $entity->setTitle($level->getTitle());
        $this->repo->save($entity);
        return $entity;
    }

    /**
     * @param $id
     * @throws NotFoundObjectException
     * @throws \CmsBundle\Exceptions\MethodNotFoundException
     */
    public function delete($id)
    {
        $this->repo->softDelete($id);
    }

    /**
     * @param $name
     * @throws FoundObjectException
     */
    private function checkTitleLevel($name)
    {
        $record = $this->repo->findRecordBy(["title"=> $name]);
        if($record!== []){
            throw new FoundObjectException ("Title value already exists, please change");
        }
    }

    /**
     * @param $name
     * @param $id
     * @throws FoundObjectException
     */
    private function checkTitleLevelExceptThisId($name, $id)
    {
        $record = $this->repo->findOneRecordBy(["title"=> $name]);

        if($record !== null) {
            if($record->getId() != $id) {
                throw new FoundObjectException ("Title value already exists in another object, please change");
            }
        }
    }
}