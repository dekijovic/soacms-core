<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/11/2018
 * Time: 12:18 AM
 */

namespace CmsBundle\Controller;


use CmsBundle\RequestModel\Credentials;
use CmsBundle\Services\SecurityService;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use CmsBundle\Exceptions\CmsException;

class ClientAppController extends MainController
{


    /**
     * Creating ClientApp for providing clientId witch identifies client App
     * @Rest\Post("/oauth/client/create")
     *
     * @return mixed
     */
    public function createAppAction(Request $request)
    {
        try {
            $data = $this->getContentDecode($request);

            /** @var SecurityService $service */
            $service = $this->get("cms.security.service");

            return $this->response($service->createClientApp($data->name));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
        
    }

    /**
     * Login with username and password witch returns access token
     *
     * @Rest\Post("/oauth/login/user")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function userLoginAction(Request $request){

        try {
            $data = $this->getContentDecode($request, true);
            
            /** @var SecurityService $service */
            $service = $this->get("cms.security.service");

            return $this->response($service->userLogin(new Credentials($data)));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Login with username and password witch returns access token
     * @Rest\Post("/oauth/login/web-user")
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function webUserLoginAction(Request $request){

        try {
            $data = $this->getContentDecode($request);

            /** @var SecurityService $service */
            $service = $this->get("cms.security.service");

            return $this->response($service->webUserLogin($data->email, $data->password));
        }catch (CmsException $e){
            return $this->exceptionResponse($e);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}