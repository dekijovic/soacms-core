<?php
namespace CmsBundle\Exceptions;


class MethodNotFoundException extends CmsException
{

    public function __construct($message, $code = 405, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}