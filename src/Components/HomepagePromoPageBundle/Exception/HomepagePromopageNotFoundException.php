<?php
namespace Components\HomepagePromoPageBundle\Exception;


use CmsBundle\Exceptions\CmsException;

class HomepagePromopageNotFoundException extends CmsException
{
    public function __construct($message, $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}