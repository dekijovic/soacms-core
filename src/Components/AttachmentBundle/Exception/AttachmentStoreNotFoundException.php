<?php
namespace Components\AttachmentBundle\Exception;

use CmsBundle\Exceptions\CmsException;

class AttachmentStoreNotFoundException extends CmsException
{
    public function __construct($message, $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}