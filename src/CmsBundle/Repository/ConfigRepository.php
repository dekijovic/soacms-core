<?php

namespace CmsBundle\Repository;
use CmsBundle\Entity\Config;

/**
 * ConfigRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * if paramValue contains "value" there is a special behavior
 */
class ConfigRepository extends AbstractRepository
{

    public function findByKey($key)
    {
        /** @var Config  $row */
        $row = $this->findOneBy(["paramKey" => $key]);

        if(!$row){
            return null;
        }else{

           return $row->getParamValue();
        }

    }

    public function findConfigByKey($key)
    {
        /** @var Config  $row */
        $row = $this->findOneBy(["paramKey" => $key]);

        if(!$row){
            return null;
        }else{

            return $row;
        }

    }
}
