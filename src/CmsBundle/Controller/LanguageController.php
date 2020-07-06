<?php
namespace CmsBundle\Controller;


use CmsBundle\Exceptions\CmsException;
use CmsBundle\RequestModel\Language;
use CmsBundle\RequestModel\Level;
use CmsBundle\Services\LanguageService;
use CmsBundle\Services\StructureLevelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class LanguageController extends MainController
{

    /**
     * @Rest\Get("/language")
     *
     * @return mixed
     */
    public function indexAction()
    {
        $service = $this->get("cms.language.service");
        return $this->response($service->getAll());
    }

    /**
     * @Rest\Get("/language/{id}")
     *
     * @param $id
     * @return \CmsBundle\Entity\StructureLevel|\FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getAction($id)
    {
        try{
            /** @var StructureLevelService $service */
            $service = $this->get("cms.language.service");
            return $this->response($service->getOne($id));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Post("/language")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function create(Request $request)
    {
        try{
            /** @var LanguageService $service */
            $service = $this->get("cms.language.service");

            $data = $this->getContentDecode($request);
            $lang = Language::initialize($data->name, $data->prefix, $data->icon);

            return $this->response($service->create($lang), Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e);
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Put("/language/{id}")
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function update(Request $request, $id)
    {
        try{
            /** @var LanguageService $service */
            $service = $this->get("cms.language.service");

            $data = $this->getContentDecode($request);
            $lang = Language::initialize($data->name, $data->prefix, $data->icon);

            return $this->response($service->update($lang, $id), Response::HTTP_ACCEPTED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Delete("/language/{id}")
     * @param $id
     * @return \CmsBundle\Entity\StructureLevel|\FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteAction($id){
        try {
            $service = $this->get("cms.language.service");
            return $this->response($service->delete($id), Response::HTTP_NO_CONTENT);
       }catch (CmsException $e){
            return $this->exceptionResponseAll($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}