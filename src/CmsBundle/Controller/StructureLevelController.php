<?php
namespace CmsBundle\Controller;


use CmsBundle\Exceptions\CmsException;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\RequestModel\Level;
use CmsBundle\Services\StructureLevelService;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StructureLevelController extends MainController
{

    /**
     * @Rest\Get("/structure_level")
     *
     * @return mixed
     */
    public function indexAction()
    {
        $service = $this->get("cms.structure_level.service");
        return $this->responseWithGroups($service->getAll(), ["listLevels"]);
    }

    /**
     * @Rest\Get("/structure_level/{id}")
     *
     * @param $id
     * @return \CmsBundle\Entity\StructureLevel|\FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getAction($id)
    {
        try{
            /** @var StructureLevelService $service */
            $service = $this->get("cms.structure_level.service");
            return $this->response($service->getOne($id));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Post("/structure_level")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function create(Request $request)
    {
        try{
            /** @var StructureLevelService $service */
            $service = $this->get("cms.structure_level.service");

            $data = $this->getContentDecode($request);
            $level = Level::initialize($data->title);

            return $this->response($service->create($level), Response::HTTP_CREATED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Put("/structure_level/{id}")
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function update(Request $request, $id)
    {
        try{
            /** @var StructureLevelService $service */
            $service = $this->get("cms.structure_level.service");

            $data = $this->getContentDecode($request);
            $level = Level::initialize($data->title);

            return $this->response($service->update($level, $id), Response::HTTP_ACCEPTED);
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Delete("/structure_level/{id}")
     * @param $id
     * @return \CmsBundle\Entity\StructureLevel|\FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteAction($id){
        try {
            /** @var StructureLevelService $service */
            $service = $this->get("cms.structure_level.service");
            return $this->response($service->delete($id), Response::HTTP_NO_CONTENT);
       }catch (CmsException $e){
            return $this->exceptionResponseAll($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}