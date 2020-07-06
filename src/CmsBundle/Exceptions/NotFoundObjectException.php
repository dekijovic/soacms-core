<?php
namespace CmsBundle\Exceptions;


class NotFoundObjectException extends CmsException
{

    public function __construct($message, $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}