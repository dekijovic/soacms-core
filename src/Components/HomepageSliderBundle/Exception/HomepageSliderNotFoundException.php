<?php

namespace Components\HomepageSliderBundle\Exception;

use CmsBundle\Exceptions\CmsException;

class HomepageSliderNotFoundException extends CmsException
{

    public function __construct($message, $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}