<?php

namespace Components\GalleryBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\GalleryBundle\Service\GalleryService;
use Components\GalleryBundle\Exception\GalleryNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/gallery/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($structureComponentId)
    {
        /** @var GalleryService $service */
        $service = $this->get("gallery.component_gallery.service");
        try{
        $result = $service->getAlbum($structureComponentId);

        return $this->response($result, 200);
        }   
        catch (GalleryNotFoundException $e) {
        return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
