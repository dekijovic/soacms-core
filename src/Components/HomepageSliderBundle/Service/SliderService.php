<?php

namespace Components\HomepageSliderBundle\Service;


use CmsBundle\Repository\StructureComponentRepository;
use CmsBundle\Services\ImageProcessorService;
use CmsBundle\Services\RegisterComponentService;
use Components\HomepageSliderBundle\Entity\ComponentSlider;
use Components\HomepageSliderBundle\Entity\ComponentSliderMeta;
use Components\HomepageSliderBundle\Exception\HomepageSliderNotFoundException;
use Components\HomepageSliderBundle\Repository\ComponentSliderMetaRepository;
use Components\HomepageSliderBundle\Repository\ComponentSliderRepository;

class SliderService
{

    const COMPONENT_NAME = "homepage-slider";

    const SLIDER_TYPES = ["activity_list_slider", "banner_slider"];

    /** @var RegisterComponentService  */
    private $componentService;

    /** @var  ComponentSliderMetaRepository */
    private $repo;

    /** @var ComponentSliderRepository */
    private $sliderRepo;
    /**
     * SliderService constructor.
     * @param RegisterComponentService $registerComponentService
     * @param ComponentSliderMetaRepository $repository
     * @param ComponentSliderRepository $sliderRepository
     * @param StructureComponentRepository $structureComponentRepository
     * @param ImageProcessorService $imageProcessorService
     */
    public function __construct(RegisterComponentService $registerComponentService,
                                ComponentSliderRepository $sliderRepository,
                                ComponentSliderMetaRepository $repository,
                                StructureComponentRepository $structureComponentRepository,
                                ImageProcessorService $imageProcessorService)
    {
        $this->componentService = $registerComponentService;
        $this->repo = $repository;
        $this->sliderRepo = $sliderRepository;
        $this->structureComponentRepo = $structureComponentRepository;
        $this->processor = $imageProcessorService;
    }

    /**
     * Get All Sliders
     * @throws HomepageSliderNotFoundException
     * @return ComponentSlider[]
     */
    public function getAll()
    {
        $records = $this->sliderRepo->findAllRecords();
        if(count($records)==0){
            throw new HomepageSliderNotFoundException("No sliders found", 404);
        }
        return $records;
    }
    /**
     * Get Slider
     *
     * @param $structureComponentId
     * @return ComponentSlider
     * @throws HomepageSliderNotFoundException
     */
    public function getSliderByStructureComponent($structureComponentId)
    {
        $record = $this->sliderRepo->findOneRecordBy(["structureComponent" => $structureComponentId]);
        if(!$record){
            throw new HomepageSliderNotFoundException("Slider data not Found", 404);
        }
        return $record;
    }

    /**
     * Get Slider
     *
     * @param $id
     * @return ComponentSlider
     * @throws HomepageSliderNotFoundException
     */
    public function getSlider($id)
    {
        $record = $this->sliderRepo->findRecord($id);
        if(!$record){
            throw new HomepageSliderNotFoundException("Slider data not Found", 404);
        }
        return $record;
    }

    /**
     * Create Slider
     *
     * @param ComponentSlider $slider
     * @return ComponentSlider
     */
    public function createSlider(ComponentSlider $slider)
    {
        $structureComponent = $this->componentService->addComponentToStructureItem(self::COMPONENT_NAME, $slider->getStructureItem());
        $slider->setStructureComponent($structureComponent);
        foreach ($slider->getItems() as $item){
            $item->setSlider($slider);
        }
        $entity = $this->sliderRepo->save($slider);
        // Because of the ID, entity needs to persist in order to get ID we call two times save method
        foreach ($entity->getItems() as $eItem){
            $eItem->setImg($this->processImage($eItem));
        }

        return $this->sliderRepo->save($slider);
    }

    /**
     * Update Slider
     *
     * @param ComponentSlider $slider
     * @param $id
     * @return ComponentSlider
     */
    public function updateSlider(ComponentSlider $slider, $id)
    {
        $entity = $this->getSlider($id);

//        if($entity->getStructureComponent()->getStructureItem()->getId() != $slider->getStructureItem()){
//            $structureComponent = $this->structureComponentRepo->find($entity->getStructureComponent()->getId());
//            $structureComponent->setStructureItem($slider->getStructureItem());
//        }

        $entityItems = $entity->getItems();
        $sliderItems = $slider->getItems();
        foreach ($entityItems as $key =>$item){
            foreach ($sliderItems as $skey => $sItem){
                if($item->getId() == $sItem->getId()){
                    $item->setTitle($sItem->getTitle());
                    $item->setColor($sItem->getColor());
                    $item->setDescription($sItem->getDescription());
                    $item->setImg($this->processImage($sItem));
                    $item->setLink($sItem->getLink());
                    $item->setSlider($entity);
                    $this->repo->save($item);
                    unset($entityItems[$key]);
                    unset($sliderItems[$skey]);
                }
            }
        }
        if(count($entityItems)>0) {
            foreach ($entityItems as $dItems) {
                $this->repo->hardDelete($dItems);
            }
        }
        if(count($sliderItems)>0) {
            foreach ($sliderItems as $cItems) {
                $cItems->setSlider($entity);
                $item = $this->repo->save($cItems);
                // Because of the ID, entity needs to persist in order to get ID we call two times save method
                $cItems->setImg($this->processImage($item));
                $this->repo->save($cItems);
            }
        }
        $entity->setDescription($slider->getDescription());
        $entity->setMeta($slider->getMeta());
        $entity->setType($slider->getType());

        return $this->sliderRepo->save($entity);
    }

    /**
     * @param ComponentSliderMeta $item
     * @return mixed
     */
    private function processImage(ComponentSliderMeta $item)
    {
        $title = str_replace(" ","-",strtolower($item->getTitle()));
        $path = self::COMPONENT_NAME."/".$title."-".$item->getId();
        return $this->processor->convertImageFromBase64($item->getImg(), $path);

    }


    /**
     * Soft deletion of the slider
     *
     * @param $structureComponentId
     * @throws HomepageSliderNotFoundException
     * @throws \CmsBundle\Exceptions\MethodNotFoundException
     * @throws \CmsBundle\Exceptions\NotFoundObjectException
     */
    public function deleteSlider($structureComponentId)
    {
        $record = $this->getSlider($structureComponentId);
        $this->structureComponentRepo->softDelete($record->getStructureComponent()->getId());
        $this->sliderRepo->softDelete($record->getId());
    }
}