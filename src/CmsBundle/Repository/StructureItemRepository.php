<?php

namespace CmsBundle\Repository;
use CmsBundle\Entity\StructureItem;
use CmsBundle\Entity\StructureComponent;

/**
 * StructureItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StructureItemRepository extends AbstractRepository
{

    public function getStructureByUrl($urlName)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('si')
            ->from(StructureItem::class, 'si')
            ->where('si.urlName = :urlName')
            ->setParameter('urlName', $urlName);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param $urlName
     * @return array
     */
    public function getStructureByUrlWithComponents($urlName)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('si'
                    )
            ->from(StructureItem::class, 'si')
            ->leftJoin(StructureComponent::class , 'sc')
            ->where('si.urlName = :urlName')
            ->setParameter('urlName', $urlName);

//        var_dump($qb->getQuery()->getDQL()); die();
        return $qb->getQuery()->getResult();
    }
}
