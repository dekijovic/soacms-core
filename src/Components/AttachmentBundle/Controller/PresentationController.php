<?php

namespace Components\AttachmentBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\AttachmentBundle\Exception\AttachmentStoreNotFoundException;
use Components\AttachmentBundle\Service\AttachmentService;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/attachment-store/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($structureComponentId)
    {
        /** @var AttachmentService $service */
        $service = $this->get("attachment.component.service");
        try{
            $result = $service->getAttachmentStore($structureComponentId);

            return $this->response($result, 200);
        }
        catch (AttachmentStoreNotFoundException $e) {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
