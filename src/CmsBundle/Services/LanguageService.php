<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/27/2017
 * Time: 11:59 AM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\Language;
use CmsBundle\Entity\StructureLevel;
use CmsBundle\Exceptions\FoundObjectException;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\Repository\LanguageRepository;
use CmsBundle\RequestModel\Language as Lang;
use CmsBundle\Repository\StructureLevelRepository;

class LanguageService
{

    /**
     * @var StructureLevelRepository
     */
    private $repo;

    /**
     * StructureLevelService constructor.
     * @param LanguageRepository $repository
     */
    public function __construct(LanguageRepository $repository)
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
     * @return Language
     * @throws NotFoundObjectException
     */
    public function getOne($id)
    {
        $record = $this->repo->findRecord($id);

        if($record == null){
            throw new NotFoundObjectException("language not found");
        }
        return $record;
    }

    /**
     * @param Lang $lang
     * @return Language
     */
    public function create(Lang $lang)
    {
        $this->checkNameLanguage($lang->getName());

        $entity = new Language();
        $entity->setName($lang->getName());
        $entity->setIcon($lang->getIcon());
        $entity->setPrefix($lang->getPrefix());
        $entity->setDefault(false);
        $this->repo->save($entity);
        return $entity;
    }

    /**
     * @param Lang $lang
     * @param $id
     * @return StructureLevel
     * @throws NotFoundObjectException
     */
    public function update(Lang $lang, $id)
    {
        $entity = $this->getOne($id);
        $this->checkNameLanguageExceptThisId($lang->getName(), $id);
        $entity->setName($lang->getName());
        $entity->setIcon($lang->getIcon());
        $entity->setPrefix($lang->getPrefix());
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
    private function checkNameLanguage($name)
    {
        $record = $this->repo->findRecordBy(["name"=> $name]);
        if($record!== []){
            throw new FoundObjectException ("Name Language value already exists, please change");
        }
    }

    /**
     * @param $name
     * @param $id
     * @throws FoundObjectException
     */
    private function checkNameLanguageExceptThisId($name, $id)
    {
        $record = $this->repo->findOneRecordBy(["name"=> $name]);

        if($record !== null) {
            if($record->getId() != $id) {
                throw new FoundObjectException ("Name Language value already exists in another object, please change");
            }
        }
    }
}