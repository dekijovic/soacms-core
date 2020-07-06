<?php
namespace CmsBundle\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class InvalidParameterException extends CmsException
{

    public function __construct($message, $code = Response::HTTP_NOT_ACCEPTABLE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}