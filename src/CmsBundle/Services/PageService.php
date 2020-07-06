<?php

namespace CmsBundle\Services;


use CmsBundle\Entity\StructureLocale;
use CmsBundle\Exceptions\FoundObjectException;
use CmsBundle\Exceptions\InvalidParameterException;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\RequestModel\Page as Page;
use CmsBundle\RequestModel\PageLocale;
use CmsBundle\Registry\Constants;
use CmsBundle\Repository\LanguageRepository;
use CmsBundle\Repository\StructureItemRepository;
use CmsBundle\Entity\StructureItem;
use CmsBundle\Repository\StructureLevelRepository;
use CmsBundle\Repository\StructureLocaleRepository;
use CmsBundle\Repository\UserRepository;
use Monolog\Logger;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageService
{
    /**
     * @var StructureItemRepository
     */
    private $repo;

    /**
     * @var StructureLocaleRepository
     */
    private $structureLocaleRepo;

    /**
     * @var LanguageRepository
     */
    private $languageRepo;

    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var ImageProcessorService
     */
    private $imageProcessor;

    /**
     * @var StructureLevelRepository
     */
    private $levelRepository;

    public function __construct(
        StructureItemRepository $repository,
        StructureLocaleRepository $localeRepository,
        StructureLevelRepository $levelRepository,
        LanguageRepository $languageRepository,
        UserRepository $userRepository,
        ImageProcessorService $imageProcessorService
    )
    {
        $this->repo = $repository;
        $this->structureLocaleRepo = $localeRepository;
        $this->levelRepository = $levelRepository;
        $this->languageRepo = $languageRepository;
        $this->userRepo = $userRepository;
        $this->imageProcessor = $imageProcessorService;
    }

    /**
     * List only pages object
     * @param bool $level
     * @return array
     */
    public function listPages($level = false)
    {
        $criteria=[];
        if($level){
            $criteria["level"] = $this->levelRepository->find($level);
        }
        return $this->repo->findRecordBy($criteria);
    }

    public function listPagesByParent($id)
    {
        $criteria=["parentStructure"=>$this->getPage($id)];
        return $this->repo->findRecordBy($criteria);
    }

    /**
     * @param $id
     * @return StructureItem
     * @throws NotFoundObjectException
     */
    public function getPage($id)
    {
        $page = $this->repo->findRecord($id);
        if($page == null){
            throw  new NotFoundObjectException("Structure Item not found");
        }
        return $page;
    }

    /**
     * @param Page $page
     * @return StructureItem
     */
    public function createPage(Page $page)
    {
        $this->checkTitle($page->getTitle());
        $entity = new StructureItem();
        $entity->setTitle($page->getTitle());
        $entity->setCreatorUser($this->userRepo->findRecord($page->getCreatedUserId()));
        $entity->setUrlName($page->getUrlName());
        $entity->setCreatedAt(New \DateTime());
        $entity->setModifiedAt(New \DateTime());
        $entity->setLevel($this->levelRepository->findOneRecordBy(["title"=>$page->getLevel()]));
        $entity->setParentStructure($this->repo->findRecord($page->getParentStructureId()));

        $this->processMeta($page);
        $entity->setAdditionalMeta($this->processMeta($page));
        $this->repo->save($entity);

        $this->createPageLocale($page->getPageLocale(), $entity);
        return $entity;
    }

    public function updatePage(Page $page, $id)
    {
        $this->checkTitleExceptThisId($page->getTitle(), $id);
        $this->checkUrlExceptThisId($page->getUrlName(), $id);

        /** @var StructureItem $entity */
        $entity = $this->getPage($id);
        if($entity->getLevel()->getTitle() <> $page->getLevel()){
            $subItems = $this->repo->findRecordBy(["parentStructure" => $id]);
            if(count($subItems)>0){
                throw new FoundObjectException("this structure item has sub-items, and there for it can't be deleted");
            }
        }
        if($page->getParentStructureId() == null && $page->getLevel() <> Constants::ACTIVITY){
            throw new InvalidParameterException("parent structure has to be set if structure is not activity");
        }
        elseif($page->getParentStructureId() != null) {
            $parentEntity = $this->getPage($page->getParentStructureId());
            $levelId = $this->levelRepository->findOneRecordBy(["title"=>$page->getLevel()]);
            if (($levelId - 1) <> $parentEntity->getLevel()->getId()) {
                throw new InvalidParameterException("parent structure is not set correctly");
            }
        }

        $entity->setTitle($page->getTitle());
        $entity->setUrlName($page->getUrlName());
        $entity->setModifiedAt(New \DateTime());
        $entity->setLevel($this->levelRepository->findOneRecordBy(["title"=>$page->getLevel()]));
        $entity->setComponentStack($page->getComponentStack());
        $entity->setParentStructure($this->repo->findRecord($page->getParentStructureId()));
        $entity->setAdditionalMeta($page->getMeta());

        $this->repo->save($entity);
        $this->updatePageLocale($page->getPageLocale(), $entity);
        return $entity;
    }

    /**
     * @param PageLocale[] $locale
     * @param StructureItem $item
     */
    private function createPageLocale(array $locale, StructureItem $item)
    {
        /** @var PageLocale $l */
        foreach ($locale as $l) {
            $structureLocale = new StructureLocale();
            $structureLocale->setTitle($l->getTitle());
            $structureLocale->setContent($l->getContent());
            $structureLocale->setSeoDescription($l->getSeoDescription());
            $structureLocale->setSeoKeywords($l->getSeoKeywords());
            $structureLocale->setSeoTitle($l->getSeoTitle());
            $structureLocale->setStructureItem($item);
            $structureLocale->setLanguage($this->languageRepo->find($l->getLanguageId()));
            $this->structureLocaleRepo ->save($structureLocale);
        }
    }

    private function updatePageLocale(array $locale, StructureItem $item)
    {
        foreach ($locale as $l) {
            $structureLocale = $this->structureLocaleRepo->findOneBy(["structureItem" => $item->getId(), "language" => $l->getLanguageId()]);
            if($structureLocale == null){
                $structureLocale = new StructureLocale();
            }
            $structureLocale->setTitle($l->getTitle());
            $structureLocale->setContent($l->getContent());
            $structureLocale->setSeoDescription($l->getSeoDescription());
            $structureLocale->setSeoKeywords($l->getSeoKeywords());
            $structureLocale->setSeoTitle($l->getSeoTitle());
            $structureLocale->setStructureItem($item);
            $structureLocale->setLanguage($this->languageRepo->find($l->getLanguageId()));
            $this->structureLocaleRepo ->save($structureLocale);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getPageTemplate(array $data)
    {

        $url = Constants::HOMEPAGE_URL;

        if(isset($data['activity'])){
            $url= '/'.$data['activity'];
        }
        if(isset($data['page'])){
            $url= '/'.$data['page'];
        }
        if(isset($data['category'])){
            $url= '/'.$data['category'];
        }
        if(isset($data['product'])){
            $url= '/'.$data['product'];
        }
        $template = $this->findStructure($url);

        return $template;
    }

    /**
     * @param $urlName
     * @return StructureItem
     * @throws NotFoundObjectException
     */
    private function findStructure($urlName){

        $page = $this->repo->findOneRecordBy(array("urlName"=>$urlName));
        if(!$page){
            throw new NotFoundObjectException("Page: ".$urlName." is not found");
        }
        return $page;
    }

    public function delete($id)
    {
        $subItems = $this->repo->findRecordBy(["parentStructure" => $id]);

        if(count($subItems)>0){
            throw new FoundObjectException("this structure item has sub-items, and there for it can't be deleted");
        }
        $this->repo->softDelete($id);
    }

    /**
     * @param $name
     * @throws FoundObjectException
     */
    private function checkTitle($name)
    {
        $record = $this->repo->findRecordBy(["title"=> $name]);
        if($record!== []){
            throw new FoundObjectException ("Title value already exists, please change");
        }
    }

    /**
     * @param $name
     * @param $id
     * @throws FoundObjectException
     */
    private function checkTitleExceptThisId($name, $id)
    {
        $records = $this->repo->findRecordBy(["title"=> $name]);

        if(count($records)>1) {
            throw new FoundObjectException ("Title is duplicated in another object, please change");
        }
        if(count($records)>0) {
            if($records[0]->getId() != $id) {
                throw new FoundObjectException ("Title value already exists in another object, please change");
            }
        }
    }

    /**
     * @param $name
     * @param $id
     * @throws FoundObjectException
     */
    private function checkUrlExceptThisId($name, $id)
    {
        $records = $this->repo->findRecordBy(["urlName"=> $name]);

        if(count($records)>1) {
            throw new FoundObjectException ("UrlName is duplicated in another object, please change");
        }
        if(count($records)>0) {
            if($records[0]->getId() != $id) {
                throw new FoundObjectException ("UrlName value already exists in another object, please change");
            }
        }
    }

    /**
     * @param Page $page
     * @return array
     */
    public function processMeta(Page $page)
    {
        $meta = $page->getMeta();

        if($meta["imagBanner"] != null){
            $meta["imagBanner"] = $this->imageProcessor->convertImageFromBase64( $meta["imagBanner"], "structure-item-banners/".$page->getTitle());
        }
        if($meta["pictogram"] != null){
            $meta["pictogram"] = $this->imageProcessor->convertImageFromBase64( $meta["pictogram"], "structure-item-pictograms/".$page->getTitle());
        }

        return $meta;
    }

}