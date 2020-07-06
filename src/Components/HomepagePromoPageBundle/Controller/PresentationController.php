<?php

namespace Components\HomepagePromoPageBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\HomepagePromoPageBundle\Exception\HomepagePromopageNotFoundException;
use Components\HomepagePromoPageBundle\Service\HomepagePromopageService;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/homepage-promo-page/structure-component/{id}")
     * @return \FOS\RestBundle\View\View
     */
    public function getHomepagePromoPageByStructureComponentAction($id)
    {
        /** @var HomepagePromopageService service */
        $service = $this->container->get("homepage_promo_page.component_homepage_promo_page.service");
        try {
            $result = $service->getByStructureComponent($id);
            return $this->response($result, 200);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e);
        }
    }
    
}
