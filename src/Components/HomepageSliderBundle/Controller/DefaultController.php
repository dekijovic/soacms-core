<?php

namespace Components\HomepageSliderBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\HomepageSliderBundle\Service\SliderService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends MainController
{
    /**
     * @Route("/homepage-slider/types")
     */
    public function sliderTypesAction()
    {
        return $this->response(SliderService::SLIDER_TYPES);
    }
}
