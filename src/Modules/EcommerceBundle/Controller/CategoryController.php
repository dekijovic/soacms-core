<?php

namespace Modules\EcommerceBundle\Controller;

use CmsBundle\Controller\MainController;
use CmsBundle\Exceptions\CmsException;
use CmsBundle\Factory\StructurePageFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends MainController
{
    /**
     * @Rest\Post("/category")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction()
    {
        try {
            $page = $this->get("cms.page.service")->getAllCategories();

            return $this->response($page, Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    
    public function createAction(Request $request)
    {
        try {
            $pageData = $this->getContentDecode($request);

            $factoryObj = (new StructurePageFactory())->getStructure($pageData);

            $page = $this->get("cms.page.service")->createPage($factoryObj);

            return $this->response($page, Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}
