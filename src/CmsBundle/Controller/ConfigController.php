<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/23/2017
 * Time: 12:36 AM
 */

namespace CmsBundle\Controller;

use CmsBundle\Services\ConfigService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConfigController extends MainController
{

    /**
     * @Rest\Get("/config")
     *
     * @return mixed
     */
    public function getAllAction()
    {
        /** @var ConfigService $service */
        $service = $this->get("cms.config.service");
        return $this->response($service->getConfig());
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Rest\Post("/config/set-values")
     */
    public function setDefaultConfigValues()
    {
        $this->get("cms.config.service")->setConfig();
        return $this->response(["message"=>"Default settings imported successfully"]);
    }
}