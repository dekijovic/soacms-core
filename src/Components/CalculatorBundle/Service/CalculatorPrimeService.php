<?php
namespace Components\CalculatorBundle\Service;


use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\RegisterComponentService;
use Components\CalculatorBundle\Entity\ComponentCalculatorPrime;
use Components\CalculatorBundle\Repository\ComponentCalculatorPrimeRepository;

class CalculatorPrimeService
{

    const COMPONENT_NAME = "calculator-prime";

    private $structureComponentRepo;
    private $componentService;

    public function __construct(StructureComponentRepository $structureComponentRepository,
                                RegisterComponentService $componentService,
                                ComponentCalculatorPrimeRepository $repository)
    {

        $this->structureComponentRepo = $structureComponentRepository;
        $this->componentService = $componentService;
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return ComponentCalculatorPrime
     * @throws NotFoundObjectException
     */
    public function getByStructureComponent($id)
    {
        $result = $this->repository->findOneRecordBy(['structureComponent' => $id]);

        if(!$result){
            throw new NotFoundObjectException("No Calculator found");
        }
        return $result;
    }

}