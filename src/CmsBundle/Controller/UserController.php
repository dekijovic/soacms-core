<?php
namespace CmsBundle\Controller;

use CmsBundle\Exceptions\CmsException;
use CmsBundle\Services\UserService;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends MainController
{

    /**
     * @Rest\Get("/users")
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the users"
     * )
     * @SWG\Tag(name="users")
     * @return View
     */
    public function getAllUsersAction()
    {
        try{
            /** @var UserService $service */
            $service = $this->get("cms.user.service");

            return $this->response($service->getUsers());

        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Get("/web-users")
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the users"
     * )
     * @SWG\Tag(name="users")
     * @return View
     */
    public function getAllWebUsersAction()
    {
        try{
            /** @var UserService $service */
            $service = $this->get("cms.user.service");

            return $this->response($service->getWebUsers());

        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Get("/users/{id}")
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the users"
     * )
     * @SWG\Tag(name="users")
     * @param $id
     * @return View
     */
    public function getOneUserAction($id)
    {
        try{
            /** @var UserService $service */
            $service = $this->get("cms.user.service");

            return $this->response($service->getOneUser($id));

        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e);
        }
    }

    /**
     * @Rest\Get("/web-users/{id}")
     * @SWG\Response(
     *     response=200,
     *     description = "Returns all the users"
     * )
     * @SWG\Tag(name="users")
     * @param $id
     * @return View
     */
    public function getOneWebUserAction($id)
    {
        try{
            /** @var UserService $service */
            $service = $this->get("cms.user.service");

            return $this->response($service->getOneWebUser($id));

        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e);
        }
    }
}