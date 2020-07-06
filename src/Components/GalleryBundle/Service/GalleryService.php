<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 11/24/2017
 * Time: 6:38 PM
 */

namespace Components\GalleryBundle\Service;

use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\RegisterComponentService;
use Components\GalleryBundle\Entity\ComponentGalleryAlbum;
use Components\GalleryBundle\Repository\ComponentGalleryAlbumItemRepository;
use Components\GalleryBundle\Repository\ComponentGalleryAlbumRepository;
use Components\GalleryBundle\Exception\GalleryNotFoundException;

class GalleryService
{

    /** const */
    const COMPONENT_NAME = "gallery";

    /** @var ComponentGalleryAlbumItemRepository  */
    private $albumRepo;
    /** @var ComponentGalleryAlbumItemRepository  */
    private $albumItemRepo;
    /** @var StructureComponentRepository  */
    private $structureComponentRepo;
    /** @var RegisterComponentService  */
    private $componentService;

    /**
     * GalleryService constructor.
     * @param ComponentGalleryAlbumRepository $album
     * @param ComponentGalleryAlbumItemRepository $albumItem
     * @param StructureComponentRepository $structureComponentRepository
     * @param RegisterComponentService $componentService
     */
    public function __construct(ComponentGalleryAlbumRepository $album,
                                ComponentGalleryAlbumItemRepository $albumItem,
                                StructureComponentRepository $structureComponentRepository,
                                RegisterComponentService $componentService)
    {
        $this->albumRepo = $album;
        $this->albumItemRepo = $albumItem;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->componentService = $componentService;
    }

    /**
     * @param $structureComponentId
     * @return ComponentGalleryAlbum
     * @throws GalleryNotFoundException
     */
    public function getAlbum($structureComponentId)
    {

        $record = $this->albumRepo->findOneRecordBy(["structureComponent" => $structureComponentId]);
        if(!$record){
            throw new GalleryNotFoundException("Album data not Found", 404);
        }
        return $record;

    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->albumRepo->findRecordBy([]);
    }

    public function createAlbum()
    {

    }

    /**
     * TODO: add images, exclude images, delete images, rewrite data images all on one save
     */
    public function updateAlbum()
    {

    }

    /**
     * @param $id
     * @throws GalleryNotFoundException
     */
    public function deleteAlbum($id)
    {
        $record = $this->getAlbum($id);
        $this->structureComponentRepo->softDelete($record->getStructureComponent()->getId());
        $this->albumRepo->softDelete($record->getId());
    }

}