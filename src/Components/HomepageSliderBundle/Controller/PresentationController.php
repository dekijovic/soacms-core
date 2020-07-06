<?php

namespace Components\HomepageSliderBundle\Controller;


use CmsBundle\Controller\MainController;
use CmsBundle\Exceptions\CmsException;
use Components\HomepageSliderBundle\Service\SliderService;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/homepage-slider/structure-component/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function getComponentSliderAction($structureComponentId)
    {
        try {
            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->getSliderByStructureComponent($structureComponentId));
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}