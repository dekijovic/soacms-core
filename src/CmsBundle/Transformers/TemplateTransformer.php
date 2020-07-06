<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 10/17/2017
 * Time: 7:37 PM
 */

namespace CmsBundle\Transformers;

use CmsBundle\Entity\StructureComponent;
use CmsBundle\RequestModel\Component;
use CmsBundle\Entity\StructureItem;
use CmsBundle\RequestModel\Page;
use CmsBundle\ResponseModel\Template;

class TemplateTransformer
{

    /**
     * @param StructureItem $item
     * @return Component
     */
    public function transform(StructureItem $item)
    {
        $componentTransformer = new ComponentTransformer();
        $components =[];
        /** @var StructureComponent $i */
        foreach($item->getComponents() as $i){
            if($i->getDeletedAt()== null) {
                $components[] = $componentTransformer->transform($i);
            }
        }

        $pageLocaleTransformer = new PageLocaleTransformer();
        $locales =[];
        foreach($item->getStructureLocales() as $i){
            $locales[] = $pageLocaleTransformer->transform($i);
        }


        $parent = ($item->getParentStructure() == null) ? null: $item->getParentStructure()->getId();
        $levelId = ($item->getLevel() == null) ? null: $item->getLevel()->getId();
        $levelName = ($item->getLevel() == null) ? null: $item->getLevel()->getTitle();

        $pictogram = $item->getAdditionalMeta("pictogram");
        $color = $item->getAdditionalMeta("color");
        $pictogramLarge = $item->getAdditionalMeta("pictogramLarge");
        $pictogramLargeHover = $item->getAdditionalMeta("pictogramLargeHover");
        $pictogramHover = $item->getAdditionalMeta("pictogramHover");
        $navBanner = $item->getAdditionalMeta("navBanner");
        $imgBanner = $item->getAdditionalMeta("imgBanner");
        $pageType = $item->getAdditionalMeta("pageType") !== null ? $item->getAdditionalMeta("pageType"): Page::PAGE_TYPE;
        return new Template($item->getId(),
                            $item->getTitle(),
                            $item->getUrlName(),
                            $locales,
                            $levelId,
                            $levelName,
                            $parent,
                            $components,
                            $item->getComponentStack(),
                            $imgBanner,
                            $color,
                            $pageType,
                            $pictogramLarge,
                            $pictogramLargeHover,
                            $pictogram,
                            $pictogramHover,
                            $navBanner
                            );
    }

    /**
     * @param array $items
     * @return array
     */
    public function transformForList(array $items)
    {
        $arr = [];
        foreach ($items as $item) {
            $arr[] = $this->transform($item);
        }
        return $arr;
    }
    
}