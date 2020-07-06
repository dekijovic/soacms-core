<?php

namespace CmsBundle\Controller;

use CmsBundle\Exceptions\CmsException;
use CmsBundle\RequestModel\ListItem;
use CmsBundle\RequestModel\ListType;
use CmsBundle\Services\ListService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class ListController
 * @package CmsBundle\Controller
 */
class ListController extends MainController
{

    /**
     * @Rest\Get("/list/type")
     * @return \FOS\RestBundle\View\View
     */
    public function allListTypeAction()
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->getAllListTypes());
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Get("/list/type/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function getListTypeAction($id)
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->getListType($id));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Post("/list/type")
     * @return mixed
     *
     */
    public function createListTypeAction(Request $request)
    {
        try{
            $data = $request->getContent();
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ListType::class, 'json');
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->createListType($obj), Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Put("/list/type/{id}")
     * @return mixed
     */
    public function updateListTypeAction(Request $request, $id)
    {
        try{
            $data = $request->getContent();
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ListType::class, 'json');
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->updateListType($obj, $id), Response::HTTP_ACCEPTED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Delete("/list/type/{$id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteListTypeAction($id)
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->deleteListType($id), Response::HTTP_NO_CONTENT);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Get("/list")
     * @return \FOS\RestBundle\View\View
     */
    public function allListAction()
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->getAllLists());
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Get("/list/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function getListAction($id)
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->getList($id));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Post("/list")
     * @return mixed
     */
    public function createListAction(Request $request)
    {
        try{
            $data = $request->getContent();
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ListItem::class, 'json');
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->createList($obj), Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Put("/list/{id}")
     * @return mixed
     */
    public function updateListAction(Request $request, $id)
    {
        try{
            $data = $request->getContent();
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ListItem::class, 'json');
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->updateList($obj, $id), Response::HTTP_ACCEPTED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Delete("/list/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteListAction($id)
    {
        try{
            /** @var ListService $service */
            $service = $this->get("cms.list.service");
            return $this->response($service->deleteList($id), Response::HTTP_NO_CONTENT);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}