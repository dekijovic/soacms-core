<?php

namespace Components\HomepagePromoPageBundle\Service;

use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\ImageProcessorService;
use CmsBundle\Services\RegisterComponentService;
use Components\HomepagePromoPageBundle\Entity\ComponentHomepagePromopageMeta;
use Components\HomepagePromoPageBundle\Repository\ComponentHomepagePromopageMetaRepository;
use Components\HomepagePromoPageBundle\Exception\HomepagePromopageNotFoundException;
use Components\HomepagePromoPageBundle\RequestModel\HomepagePromopageMeta as RequestObject;

class HomepagePromopageService
{
    /** const */
    const COMPONENT_NAME = "homepage-promo-page";

    /** @var ComponentHomepagePromopageMetaRepository  */
    private $repo;

    /** @var StructureComponentRepository  */
    private $structureComponentRepo;

    /** @var RegisterComponentService  */
    private $componentService;

    /**
     * HomepagePromopageService constructor.
     * @param ComponentHomepagePromopageMetaRepository $repository
     * @param StructureComponentRepository $structureComponentRepository
     * @param RegisterComponentService $componentService
     * @param ImageProcessorService $imageProcessorService
     */
    public function __construct(ComponentHomepagePromopageMetaRepository $repository,
                                StructureComponentRepository $structureComponentRepository,
                                RegisterComponentService $componentService,
                                ImageProcessorService $imageProcessorService)
    {
        $this->repo = $repository;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->componentService = $componentService;
        $this->processor = $imageProcessorService;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->repo->findRecordBy([]);
    }
    /**
     * @param $structureComponentId
     * @return ComponentHomepagePromopageMeta
     * @throws HomepagePromopageNotFoundException
     */
    public function getByStructureComponent($structureComponentId)
    {
        $record = $this->repo->findOneRecordBy(["structureComponent" => $structureComponentId]);
        if(!$record){
            throw new HomepagePromopageNotFoundException("ComponentMeta data not Found", 404);
        }
        return $record;
    }

    /**
     * @param $id
     * @return ComponentHomepagePromopageMeta
     * @throws HomepagePromopageNotFoundException
     */
    public function get($id)
    {
        $record = $this->repo->findRecord($id);
        if(!$record){
            throw new HomepagePromopageNotFoundException("ComponentMeta data not Found", 404);
        }
        return $record;
    }

    /**
     * @param RequestObject $meta
     * @return ComponentHomepagePromopageMeta
     */
    public function create(RequestObject $meta)
    {
        $entity = new ComponentHomepagePromopageMeta();
        $entity->setBackgroundColor($meta->getBackgroundColor());
        $entity->setTitle($meta->getTitle());
        $entity->setContent($meta->getContent());
        $entity->setType($meta->getType());
        $entity->setLink($meta->getLink());

        $this->repo->save($entity);

        $entity->setImg($this->processImage($entity, $meta->getImage()));
        $this->repo->save($entity);

        return $entity;
    }

    /**
     * @param ComponentHomepagePromopageMeta $item
     * @return mixed
     */
    private function processImage(ComponentHomepagePromopageMeta $item, $base64)
    {
        $title = str_replace(" ","-",str_replace(" - ","-",strtolower($item->getTitle())));
        $path = self::COMPONENT_NAME."/".$title."-".$item->getId();
        return $this->processor->convertImageFromBase64($base64, $path);

    }

    /**
     * @param $structureItemId
     * @param $id
     * @return ComponentHomepagePromopageMeta
     * @throws HomepagePromopageNotFoundException
     */
    public function mergeStructureComponent($structureItemId, $id)
    {
        $entity = $this->get($id);
        $structureComponent = $this->componentService->addComponentToStructureItem(self::COMPONENT_NAME, $structureItemId);
        $entity->setStructureComponent($structureComponent);
        return $this->repo->save($entity);
    }

    /**
     * @param RequestObject $meta
     * @param $id
     * @return ComponentHomepagePromopageMeta
     */
    public function update(RequestObject $meta, $id)
    {
        $entity = $this->get($id);
        $entity->setBackgroundColor($meta->getBackgroundColor());
        $entity->setTitle($meta->getTitle());
        $entity->setContent($meta->getContent());
        $entity->setImg($meta->getImage());
        $entity->setType($meta->getType());
        $entity->setLink($meta->getLink());

        $this->repo->save($entity);

        return $entity;
    }

    /**
     * @param $id
     * @throws HomepagePromopageNotFoundException
     */
    public function delete($id)
    {
        $record = $this->get($id);
        if($record->getStructureComponent() !== null ) {
            $this->structureComponentRepo->softDelete($record->getStructureComponent()->getId());
        }
        $this->repo->softDelete($record->getId());
    }

}