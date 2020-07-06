<?php
namespace Components\ContentBundle\Service;


use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\RegisterComponentService;
use Components\ContentBundle\Exception\ContentNotFoundException;
use Components\ContentBundle\Repository\ComponentContentRepository;

class ContentService
{
    /** @var StructureComponentRepository  */
    private $structureComponentRepo;
    /** @var RegisterComponentService  */
    private $componentService;
    /** @var ComponentContentRepository  */
    private $repo;

    /**
     * ContentService constructor.
     * @param ComponentContentRepository $repository
     * @param StructureComponentRepository $structureComponentRepository
     * @param RegisterComponentService $componentService
     */
    public function __construct(ComponentContentRepository $repository,
                                StructureComponentRepository $structureComponentRepository,
                                RegisterComponentService $componentService)
    {
        $this->repo = $repository;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->componentService = $componentService;
    }

    /**
     * @param $structureComponentId
     * @return null|object
     * @throws ContentNotFoundException
     */
    public function getContent($structureComponentId)
    {
        $record = $this->repo->findOneRecordBy(["structureComponent" => $structureComponentId]);
        if(!$record){
            throw new ContentNotFoundException("Attachment store not Found");
        }
        return $record;
    }
}