<?php

namespace Components\GalleryBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\GalleryBundlee\Exception\GalleryNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class AdminController extends MainController
{
    /**
     * @Rest\Get("/gallery")
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction()
    {
        $service = $this->get("gallery.component_gallery.service");
        try{
            $result = $service->getAll();

            return $this->response($result, 200);
        }
        catch (GalleryNotFoundException $e) {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Delete("/gallery/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction($structureComponentId)
    {
        try {
            $service = $this->get("gallery.component_gallery.service");
            $service->delete($structureComponentId);
            return $this->response("", Response::HTTP_NO_CONTENT);
        }catch (GalleryNotFoundException $e)
        {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }
}
