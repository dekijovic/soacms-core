<?php

namespace Components\CalculatorBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\CalculatorBundle\Service\CalculatorPrimeService;
use Components\CalculatorBundle\Transformer\CalculatorPrimeTransformer;
use Components\HomepagePromoPageBundle\Exception\CalculatorNotFoundException;
use FOS\RestBundle\Controller\Annotations as Rest;

class PresentationController extends MainController
{
    /**
     * @Rest\Get("/calculator/structure-component/{structureComponentId}")
     * @param $structureComponentId
     * @return \FOS\RestBundle\View\View
     */
    public function calculatorPageAction($structureComponentId)
    {
        /** @var CalculatorPrimeService $service */
        $service = $this->container->get("calculator_prime.calculator.service");
        $currencyService = $this->container->get("calculator_prime.currency.service");
        try {
            $result = $service->getByStructureComponent($structureComponentId);
            $result = CalculatorPrimeTransformer::getInstance()->transfrom($result, $currencyService);
            return $this->response($result, 200);
        }catch (CalculatorNotFoundException $e)
        {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e);
        }
    }

}
