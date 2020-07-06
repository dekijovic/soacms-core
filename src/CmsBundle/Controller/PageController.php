<?php

namespace CmsBundle\Controller;

use CmsBundle\Exceptions\CmsException;
use CmsBundle\Factory\StructurePageFactory;
use CmsBundle\RequestModel\PageLocale;
use CmsBundle\Registry\Constants;
use CmsBundle\Services\PageService;
use CmsBundle\Transformers\TemplateTransformer;
use JMS\Serializer\SerializationContext;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PageController extends MainController
{

    /**
     * @Rest\Get("/pages")
     *
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the pages"
     * )
     * @SWG\Tag(name="pages")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $level = $request->get("level");
        
        /** @var PageService $service */
        $service = $this->get('cms.page.service');
        $serializer = $this->get("jms_serializer");

        $response = $serializer->serialize(
            $service->listPages($level),
            'json',
            SerializationContext::create()->setGroups(array('listPages'))->setSerializeNull(true)->enableMaxDepthChecks()
        );
        return new Response($response);
    }


    /**
     * @Rest\Get("/pages/parent/{id}")
     *
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the pages"
     * )
     * @SWG\Tag(name="pages")
     * @return Response
     */
    public function subItemsListAction($id)
    {
        /** @var PageService $service */
        $service = $this->get('cms.page.service');
        try {
            $responseList = $service->listPagesByParent($id);
            $responseTransformedList = [];
            foreach ($responseList as $r){
                $responseTransformedList[] = (new TemplateTransformer())->transform($r);
            }
            return $this->response($responseTransformedList, Response::HTTP_OK);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Get("/pages/template")
     * @SWG\Response(
     *     response=200,
     *     description="Returns specific page"
     * )
     * @SWG\Parameter(
     *     name="activity",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * ),
     * * @SWG\Parameter(
     *     name="category",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * ),
     * * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * ),
     * * @SWG\Parameter(
     *     name="product",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="pages")
     */
    public function templateAction(Request $request)
    {
        $data = $this->packingParams($request);
        /** @var PageService $service */
        $service = $this->get('cms.page.service');
        try {
            $response = (new TemplateTransformer())->transform($service->getPageTemplate($data));
            return $this->response($response, Response::HTTP_OK);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Get("/pages/template/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function templateByIdAction($id)
    {
        /** @var PageService $service */
        $service = $this->get('cms.page.service');
        try {
            $response = (new TemplateTransformer())->transform($service->getPage($id));
            return $this->response($response, Response::HTTP_OK);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    private function packingParams(Request $request)
    {
        $data = [];
        $params = [
            Constants::ACTIVITY,
            Constants::PAGE,
            Constants::CATEGORY,
            Constants::PRODUCT,
            Constants::LANGUAGE
        ];

        foreach($params as $el){
            if(($request->get($el) !== NULL) && ($request->get($el) !== "")){
                $data[$el] = $request->get($el);
            }
        }
        return $data;
    }


    /**
     * @Rest\Get("/pages/{id}")
     * @SWG\Response(
     *     response=200,
     *     description="Returns specific page"
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="pages")
     */
    public function oneAction($id)
    {
        /** @var PageService $service */
        $service = $this->get('cms.page.service');

        return $this->response($service->getPage($id), Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/pages")
     *
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the pages"
     * )
     * @SWG\Tag(name="pages")
     * @param Request $request
     * @return Response
     */
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

    /**
     * @Rest\Put("/pages/{id}")
     *
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function updateAction(Request $request, $id)
    {
        try {
            $pageData = $this->getContentDecode($request);

            $factoryObj = (new StructurePageFactory())->getStructure($pageData);

            $page = $this->get("cms.page.service")->updatePage($factoryObj, $id);

            return $this->response($page, Response::HTTP_ACCEPTED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Delete("/pages/{id}")
     *
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction($id)
    {
        try {
            $page = $this->get("cms.page.service")->delete($id);

            return $this->response($page, Response::HTTP_NO_CONTENT);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}