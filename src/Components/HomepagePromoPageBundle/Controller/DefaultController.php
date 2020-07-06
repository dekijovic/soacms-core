<?php

namespace Components\HomepagePromoPageBundle\Controller;

use CmsBundle\Controller\MainController;
use Components\HomepagePromoPageBundle\Entity\ComponentHomepagePromopageMeta;
use Components\HomepagePromoPageBundle\Exception\HomepagePromopageNotFoundException;
use Components\HomepagePromoPageBundle\RequestModel\HomepagePromopageMeta;
use Components\HomepagePromoPageBundle\Service\HomepagePromopageService;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class DefaultController extends MainController
{
    /**
     * @Rest\Get("/homepage-promo-page")
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction()
    {
        /** @var HomepagePromopageService service */
        $service = $this->container->get("homepage_promo_page.component_homepage_promo_page.service");
        return $this->response($service->getAll());
    }

    /**
     * @Rest\Get("/homepage-promo-page/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id)
    {
        /** @var HomepagePromopageService $service */
        $service = $this->container->get("homepage_promo_page.component_homepage_promo_page.service");
        try {
            $result = $service->get($id);
            return $this->response($result, 200);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @Rest\Post("/homepage-promo-page")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function createAction(Request $request)
    {
        try {
            $data = $request->getContent();
            /** @var Serializer $serializer */
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, HomepagePromopageMeta::class, 'json');
            /** @var HomepagePromopageService $service */
            $service = $this->get("homepage_promo_page.component_homepage_promo_page.service");
            $record = $service->create($obj);
            return $this->response($record);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);

        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @Rest\Put("/homepage-promo-page/{id}/merge-structure-component/{structureItemId}")
     * @param $structureItemId
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function mergeStructureComponent($id, $structureItemId)
    {
        try {
            /** @var HomepagePromopageService $service */
            $service = $this->get("homepage_promo_page.component_homepage_promo_page.service");
            $record = $service->mergeStructureComponent($structureItemId, $id);
            return $this->response($record);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);

        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @Rest\Put("/homepage-promo-page/{id}")
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function updateAction(Request $request, $id)
    {
        try {
            $data = $request->getContent();
            /** @var Serializer $serializer */
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, HomepagePromopageMeta::class, 'json');
            /** @var HomepagePromopageService $service */
            $service = $this->get("homepage_promo_page.component_homepage_promo_page.service");
            $record = $service->update($obj, $id);
            return $this->response($record);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);

        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    /**
     * @Rest\Delete("/homepage-promo-page/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction($id)
    {
        try {
            $service = $this->container->get("homepage_promo_page.component_homepage_promo_page.service");
            $service->delete($id);
            return $this->response("", Response::HTTP_NO_CONTENT);
        }catch (HomepagePromopageNotFoundException $e)
        {
            return $this->exceptionResponse($e);
        }catch (\Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }
    
}
