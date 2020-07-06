<?php
namespace CmsBundle\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class FoundObjectException extends CmsException
{

    public function __construct($message, $code = Response::HTTP_FOUND, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}