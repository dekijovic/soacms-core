<?php
namespace CmsBundle\Repository;


use CmsBundle\Exceptions\MethodNotFoundException;
use CmsBundle\Exceptions\NotFoundObjectException;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Exception\MethodNotImplementedException;

class AbstractRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $entity
     * @return Object
     */
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws NotFoundObjectException
     * @throws MethodNotFoundException
     */
    public function softDelete($id)
    {
        $record = $this->_em->find($this->_entityName,$id);
        if($record == null){
            throw new NotFoundObjectException("Record not found for deletion");
        }
        if(!method_exists($record,"setDeletedAt")){
            throw new MethodNotFoundException("Soft delete not possible method setDeletedAt not implemented", Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $record->setDeletedAt(new \DateTime("now"));
        $this->save($record);
    }

    /**
     * @param $entity
     */
    public function hardDelete($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    /**
     * @return array
     */
    public function findAllRecords()
    {
        $criteria["deletedAt"] = null;
        return $this->findBy($criteria);
    }

    /**
     * @param $criteria
     * @return array
     */
    public function findRecordBy($criteria)
    {
        $criteria["deletedAt"] = null;
        return $this->findBy($criteria);
    }

    /**
     * @param $criteria
     * @return null|object
     */
    public function findOneRecordBy($criteria)
    {
        $criteria["deletedAt"] = null;
        return $this->findOneBy($criteria);
    }

    /**
     * @param $id
     * @return null|object
     */
    public function findRecord($id)
    {
        $criteria["id"] = $id;
        $criteria["deletedAt"] = null;
        return $this->findOneBy($criteria);
    }
}