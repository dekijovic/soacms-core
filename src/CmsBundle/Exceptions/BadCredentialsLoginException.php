<?php
namespace CmsBundle\Exceptions;


class BadCredentialsLoginException extends CmsException
{

    public function __construct($message, $code = 401, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}