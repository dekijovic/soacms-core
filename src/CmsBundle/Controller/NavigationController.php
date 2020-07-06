<?php

namespace CmsBundle\Controller;

use CmsBundle\Exceptions\CmsException;
use CmsBundle\Services\ImageProcessorService;
use CmsBundle\Services\NavigationService;
use FOS\RestBundle\Controller\Annotations as Rest;

class NavigationController extends MainController
{

    /**
     * @Rest\Get("/navigation/create/{name}")
     * @return mixed
     */
    public function navGenerateAction($name){
        try {
            /** @var NavigationService $service */
            $service = $this->get("cms.navigation.service");
            return $this->responseWithGroups($service->generateMainNav(), ["mainmanu"]);
        }catch ( CmsException $e)
        {
            $this->exceptionResponse($e);
        }catch ( \Exception $e)
        {
            $this->errorResponse($e);
        }
    }
    /**
     * @Rest\Get("/navigation/{name}")
     * @return mixed
     */
    public function navAction($name)
    {
        try {
            /** @var NavigationService $service */
            $service = $this->get("cms.navigation.service");
            return $this->response($service->getMenu($name));
        }catch ( CmsException $e)
        {
            $this->exceptionResponse($e);
        }catch ( \Exception $e)
        {
            $this->errorResponse($e->getMessage());
        }
    }
}