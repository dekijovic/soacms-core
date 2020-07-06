<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/18/2017
 * Time: 11:29 PM
 */

namespace Components\ReferencesBundle\Service;


use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\Repository\ConfigRepository;
use CmsBundle\Services\ImageProcessorService;
use Components\ReferencesBundle\Entity\ComponentReferenceItem;
use Components\ReferencesBundle\Repository\ComponentReferenceItemRepository;

class ReferenceService
{

    const COMPONENT_NAME = "references";

    const REFERENCES_SHOW_LIMIT = "references_show_limit";


    /** @var  ComponentReferenceItemRepository */
    private $repo;

    /** @var ImageProcessorService */
    private $processor;

    /** @var ConfigRepository  */
    private $configRepo;

    /**
     * ReferenceService constructor.
     * @param ComponentReferenceItemRepository $repository
     * @param ImageProcessorService $imageProcessorService
     */
    public function __construct(
                                ComponentReferenceItemRepository $repository,
                                ImageProcessorService $imageProcessorService,
                                ConfigRepository $configRepository)
    {
        $this->repo = $repository;
        $this->processor = $imageProcessorService;
        $this->configRepo = $configRepository;
    }

    /**
     * Create update delete items for referent list
     *
     * @param ComponentReferenceItem[] $items
     * @return ComponentReferenceItem[]
     */
    public function updateList(array $items)
    {
        $forUpdatingItems = [];
        $forAddingItems = [];
        $forDeletionItems = [];
        $ids = [];
        foreach ($items as $item){
            if($item->getId() != null) {
                $forUpdatingItems[$item->getId()] = $item;
                $ids[] = $item->getId();
            }else{
                $forAddingItems[] = $item;
            }
        }
        $entities = $this->repo->findAll();
        if(count($ids)>0) {
            foreach ($entities as $entity) {
                $shouldSave = false;
                if(in_array($entity->getId(), $ids)) {
                    $newEntityData = $forUpdatingItems[$entity->getId()];
                    ($entity->getTitle() !== $newEntityData->getTitle()) ? $shouldSave = true : $entity->setTitle($newEntityData->getTitle());
                    $entity->setImg($this->processImage($entity));
                    ($entity->getLink() !== $newEntityData->getLink()) ? $shouldSave = true : $entity->setLink($newEntityData->getLink());
                    ($entity->getAlt() !== $newEntityData->getAlt()) ? $shouldSave = true : $entity->setAlt($newEntityData->getAlt());
                    if ($shouldSave) {
                        $this->repo->save($entity);
                    }
                }else{
                    $forDeletionItems[] = $entity;
                }
            }
        }else{
            $forDeletionItems = $entities;
        }

        foreach ($forDeletionItems as $dItem){
            $this->repo->hardDelete($dItem);
        }

        foreach ($forAddingItems as $aItem){
            $new = $this->repo->save($aItem);
            $new->setImg($this->processImage($new));
            $this->repo->save($new);
        }

        return $items;

    }

    /**
     * @param ComponentReferenceItem $item
     * @return mixed
     * @throws \CmsBundle\Exceptions\InvalidParameterException
     */
    private function processImage(ComponentReferenceItem $item)
    {
        $title = str_replace(" ","-",strtolower($item->getTitle()));
        $path = self::COMPONENT_NAME."/".$title."-".$item->getId();
        return $this->processor->convertImageFromBase64($item->getImg(), $path);

    }

    /**
     * @return ComponentReferenceItem[]
     * @throws NotFoundObjectException
     */
    public function getAll()
    {

        $limit = $this->configRepo->findByKey(self::REFERENCES_SHOW_LIMIT);

        if ( $limit != null && $limit > 0) {
                $records = $this->repo->createQueryBuilder("r")->setMaxResults($limit)->getQuery()->getResult();
        }else{
            $records = $this->repo->findAll();
        }

        if(count($records)==0){
            throw new NotFoundObjectException("There is no reference items");
        }

        return $records;
    }
}