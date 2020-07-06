<?php
namespace Components\AttachmentBundle\Service;


use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\RegisterComponentService;
use Components\AttachmentBundle\Exception\AttachmentStoreNotFoundException;
use Components\AttachmentBundle\Repository\ComponentAttachmentItemRepository;
use Components\AttachmentBundle\Repository\ComponentAttachmentStoreRepository;

class AttachmentService
{
    /** @var StructureComponentRepository  */
    private $structureComponentRepo;
    /** @var RegisterComponentService  */
    private $componentService;
    /** @var ComponentAttachmentStoreRepository  */
    private $storeRepo;
    /** @var ComponentAttachmentItemRepository  */
    private $itemRepo;

    /**
     * AttachmentService constructor.
     * @param ComponentAttachmentStoreRepository $attachmentStoreRepository
     * @param ComponentAttachmentItemRepository $attachmentItemRepository
     * @param StructureComponentRepository $structureComponentRepository
     * @param RegisterComponentService $componentService
     */
    public function __construct(ComponentAttachmentStoreRepository $attachmentStoreRepository,
                                ComponentAttachmentItemRepository $attachmentItemRepository,
                                StructureComponentRepository $structureComponentRepository,
                                RegisterComponentService $componentService)
    {
        $this->storeRepo = $attachmentStoreRepository;
        $this->itemRepo = $attachmentItemRepository;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->componentService = $componentService;
    }

    /**
     * @param $structureComponentId
     * @return mixed
     * @throws AttachmentStoreNotFoundException
     */
    public function getAttachmentStore($structureComponentId)
    {
        $record = $this->storeRepo->findOneRecordBy(["structureComponent" => $structureComponentId]);
        if(!$record){
            throw new AttachmentStoreNotFoundException("Attachment store not Found");
        }
        return $record;
    }
}