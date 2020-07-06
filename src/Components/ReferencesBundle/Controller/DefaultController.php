<?php

namespace Components\ReferencesBundle\Controller;

use CmsBundle\Controller\MainController;
use CmsBundle\Exceptions\CmsException;
use Components\ReferencesBundle\Entity\ComponentReferenceItem;
use Components\ReferencesBundle\Service\ReferenceService;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends MainController
{
    /**
     * @Rest\Post("/references")
     * @return \FOS\RestBundle\View\View
     */
    public function updateAction(Request $request)
    {
        try {
            $data = $request->getContent();
            /** @var Serializer $serializer */
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data,'array<'.ComponentReferenceItem::class.'>', 'json');

            /** @var ReferenceService $service */
            $service = $this->get("reference.component_reference.service");
            return $this->response($service->updateList($obj), Response::HTTP_ACCEPTED);
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Get("/references")
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction()
    {
        try {
            /** @var ReferenceService $service */
            $service = $this->get("reference.component_reference.service");
            return $this->response($service->getAll());
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
