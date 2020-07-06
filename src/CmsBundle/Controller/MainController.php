<?php

namespace CmsBundle\Controller;

use CmsBundle\Exceptions\CmsException;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;

class MainController extends FOSRestController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getContentDecode(Request $request, $assoc = false)
    {
        $params = $request->getContent();
        return json_decode($params, $assoc);
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @return \FOS\RestBundle\View\View
     */
    public function response($data, $status = 200, $headers=[])
    {
        return $this->view($data, $status, $headers)->setContext((new Context())->setSerializeNull(true)->enableMaxDepth());
    }

    /**
     * @param $data
     * @param $groups
     * @param int $status
     * @param array $headers
     * @return \FOS\RestBundle\View\View
     */
    public function responseWithGroups($data, $groups, $status = 200, $headers=[])
    {
        return $this->view($data, $status, $headers)->setContext((new Context())->addGroups($groups)->setSerializeNull(true)->enableMaxDepth());
    }

    /**
     * @param $msg
     * @param int $status
     * @param $headers
     * @return \FOS\RestBundle\View\View
     */
    public function errorResponse($msg, $status = 500, $headers = [])
    {
        if($msg instanceof \Exception){
            $data["message"] = "MESSAGE: ".$msg->getMessage()."; FILE:".$msg->getFile()."; LINE:".$msg->getLine()."; CODE:".$msg->getCode();
        }else {
            $this->get("logger")->error($msg);
            $data['message'] = $msg;
        }
        $this->get("logger")->error($data["message"]);
        return $this->view($data, $status, $headers);
    }

    /**
     * @param \Exception $e
     * @param array $headers
     * @return \FOS\RestBundle\View\View
     */
    public function exceptionResponse(\Exception $e, $headers = [])
    {
        $this->get("logger")->error("Message:".$e->getMessage().', Line: '. $e->getLine().', file'. $e->getFile());
        $data['message'] = $e->getMessage();
        return $this->view($data, $e->getCode(), $headers);
    }

    /**
     * @param $e
     * @return \FOS\RestBundle\View\View
     */
    public function exceptionResponseAll($e){

        if(get_class($e)== CmsException::class) {
            return $this->errorResponse($e->getMessage());
        }else{
            return $this->exceptionResponse($e);
        }
    }

}