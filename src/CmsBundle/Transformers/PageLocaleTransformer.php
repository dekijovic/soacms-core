<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 10/17/2017
 * Time: 7:37 PM
 */

namespace CmsBundle\Transformers;

use CmsBundle\Entity\StructureLocale;
use CmsBundle\RequestModel\PageLocale;

class PageLocaleTransformer
{

    /**
     * @param StructureLocale $item
     * @return PageLocale
     */
    public function transform(StructureLocale $item)
    {
        return PageLocale::initialize(
                $item->getTitle(),
                $item->getLanguage()->getId(),
                $item->getContent(),
                $item->getSeoTitle(),
                $item->getSeoKeywords(),
                $item->getSeoDescription()
            );
    }
    
}