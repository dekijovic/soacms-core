<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 10/17/2017
 * Time: 7:37 PM
 */

namespace CmsBundle\Transformers;

use CmsBundle\Entity\StructureComponent;
use CmsBundle\RequestModel\Component;

class ComponentTransformer
{

    /**
     * @param StructureComponent $component
     * @return Component
     */
    public function transform(StructureComponent $component)
    {
        return Component::initialize(
                    $component->getId(),
                    $component->getComponentRegister()->getId(),
                    $component->getComponentRegister()->getComponentName(),
                    $component->getMobile(),
                    $component->getLayout()
                );
    }
    
}