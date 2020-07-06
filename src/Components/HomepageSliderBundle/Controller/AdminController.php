<?php
namespace Components\HomepageSliderBundle\Controller;


use CmsBundle\Controller\MainController;
use CmsBundle\Exceptions\CmsException;
use Components\HomepageSliderBundle\Entity\ComponentSlider;
use Components\HomepageSliderBundle\Service\SliderService;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends MainController
{

    /**
     * @Rest\Get("/homepage-slider")
     * @return \FOS\RestBundle\View\View
     */
    public function indexAction()
    {
        try {
            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->getAll());
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    /**
     * @Rest\Get("/homepage-slider/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function getSliderAction($id)
    {
        try {
            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->getSlider($id));
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    /**
     * @Rest\Post("/homepage-slider")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function createSliderAction(Request $request)
    {
        try {
            $data = $request->getContent();
            /** @var Serializer $serializer */
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ComponentSlider::class, 'json');

            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->createSlider($obj), Response::HTTP_CREATED);
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Put("/homepage-slider/{id}")
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function updateSliderAction(Request $request, $id)
    {
        try {
            $data = $request->getContent();
            /** @var Serializer $serializer */
            $serializer = $this->get("jms_serializer");
            $obj = $serializer->deserialize($data, ComponentSlider::class, 'json');

            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->updateSlider($obj, $id), Response::HTTP_ACCEPTED);
        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Delete("/homepage-slider/{id}")
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteSliderAction($id)
    {
        try{
            /** @var SliderService $service */
            $service = $this->get('homepage_slider.slider.service');
            return $this->response($service->deleteSlider($id), Response::HTTP_NO_CONTENT);

        } catch (CmsException $e) {
            return $this->exceptionResponse($e);

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

}