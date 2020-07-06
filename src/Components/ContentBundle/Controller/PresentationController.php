<?php

namespace Components\ContentBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\ContentBundle\Exception\ContentNotFoundException;
use Components\ContentBundle\Service\ContentService;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/content/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($structureComponentId)
    {
        /** @var ContentService $service */
        $service = $this->get("content.component.service");
        try{
            $result = $service->getContent($structureComponentId);

            return $this->response($result, 200);
        }
        catch (ContentNotFoundException $e) {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
