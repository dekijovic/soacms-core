<?php

namespace Modules\EcommerceBundle\Controller;

use CmsBundle\Controller\MainController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductController extends MainController
{
    /**
     * @Rest\Post("/product")
     */
    public function createProduct()
    {
        return $this->render('EcommerceBundle:Default:index.html.twig');
    }
}
