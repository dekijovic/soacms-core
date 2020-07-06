<?php

namespace Components\CalculatorBundle\Controller;

use CmsBundle\Controller\MainController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends MainController
{
    /**
     * @Rest\Get("/calculator")
     *
     */
    public function listAction()
    {
        return $this->response("true");
    }

    /**
     * @Rest\Get("/calculator/{id}")
     */
    public function getAction($id)
    {

    }
    /**
     * @Rest\Post("/calculator")
     * @IsGranted("ROLE_USER")
     */
    public function createCalculatorAction(Request $request)
    {

    }

    /**
     * @Rest\Put("/calculator/{id}")
     * @IsGranted("ROLE_USER")
     */
    public function updateCalculatorAction(Request $request, $id)
    {

    }

    /**
     * @Rest\Delete("/calculator/{id}")
     * @IsGranted("ROLE_USER")
     */
    public function deleteAction($id)
    {
        
    }

}
