<?php

namespace CmsBundle\Services;


use CmsBundle\Registry\Constants;
use CmsBundle\Repository\StructureItemRepository;
use CmsBundle\Repository\StructureLevelRepository;
use CmsBundle\ResponseModel\MenuItem;
use CmsBundle\Entity\StructureItem;

class NavigationService
{

    private $itemRepo;

    private $structureLevelRepo;

    private $listService;


    public function __construct(StructureItemRepository $structureItemRepository,
                                ListService $listService,
                                StructureLevelRepository $structureLevelRepository)
    {
        $this->itemRepo = $structureItemRepository;
        $this->structureLevelRepo = $structureLevelRepository;
        $this->listService = $listService;
    }

    public function generateTopNav()
    {
        $homepage = $this->itemRepo->findOneRecordBy(["urlName"=>Constants::HOMEPAGE_URL]);
        $data = $this->itemRepo->findRecordBy(["parentStructure"=>$homepage->getId()]);

        foreach ($data as $d){
            $navdata[] = ["id"=>$d->getId(), "url_name"=>$d->getUrlName(), "title"=>$d->getTitle()];
        }
        return $navdata;


    }

    public function generateMainNav()
    {
        /** @var StructureItem[] $data */
        $data = $this->itemRepo->findAllRecords();
        $levels = $this->structureLevelRepo->getLevelsIds();


        $children = [];
        foreach ($data as $item){
            if($item->getParentStructure() == NULL){
                $homepage = $item->getId();
                $children[$homepage] = ["level"=>0, "child"=>[], "value"=>$item];
                continue;
            }
            if(isset($children[$item->getParentStructure()->getId()])){
                $children[$item->getParentStructure()->getId()]["child"][]= $item->getId();
                $children[$item->getId()] =["child"=>[],"value"=>$item];
            }else{
                $children[$item->getParentStructure()->getId()] = ["child"=>[], "value"=>$item];
            }
        }

        foreach ($children as $key =>$child){

            if(count($child["child"])==0){
                continue;
            }
            foreach ($children as $ckey =>$cchild){
                if(in_array($ckey,$child["child"])){
                    if(isset($children[$key]["level"])){
                        $children[$ckey]["level"] = $children[$key]["level"]+1;
                        $children[$ckey]["parent"] =$key;
                    }
                }
            }
        }

        foreach ($children as $key =>$child){

            $arr[$child["level"]][$key] = $child;
        }

        for($i=3; $i>0; $i--){
            foreach ($arr[$i] as $key => $child){
                if(!isset($arr[$i-1][$child["parent"]]["sub"])){
                    $arr[$i-1][$child["parent"]]["sub"] = [];
                }
                $arr[$i-1][$child["parent"]]["sub"][]=$child;
                unset($arr[$i][$key]);
            }
        }

        $mainManu = [];
        foreach ($arr[0][$homepage]["sub"] as $item){

            if($item["value"]->getParentStructure()->getId() == $homepage && $item["value"]->getLevel()->getId() == $levels[Constants::PAGE]){
                $topmManu[] = $item;
                continue;
            }


            $sub = isset($item["sub"])?$item["sub"]:null;
                $mainManu[] = ["id" => $item["value"]->getId(), "sub" =>  $this->getSubs($sub)];
        }

        return  $this->listService->createMainMenu($mainManu);



//        foreach ($data as $item){
//            if($item->getLevel()->getId() == $levels[Constants::ACTIVITY]) {
//                $activities[] = $item;
//            }else if($item->getLevel()->getId() == $levels[Constants::CATEGORY]){
//                $categories[] = $item;
//            }else if($item->getLevel()->getId() == $levels[Constants::PAGE]){
//                $pages[] = $item;
//            }
//        }
//
//        foreach ($activities as $akey => $activity){
//
//            $nav[$akey] = ["item"=>$activity, "sub"=>[]];
//            foreach ($categories as $ckey => $category){
//                $categoryParent = ($category->getParentStructure()!= null)?:$category->getParentStructure()->getId();
//                if($activity->getId() == $categoryParent){
//                    $nav[$akey]["sub"][]=["item"=>$category, "sub"=>[]];
//                }
//                foreach ($pages as $pkey =>$page){
//                    $pageParent = ($page->getParentStructure()!= null)?:$page->getParentStructure()->getId();
//                    if($activity->getId() == $pageParent){
//                        $nav[$akey]["sub"][$ckey]["sub"][]=["item"=>$page, "sub"=>[]];
//                    }
//                    unset($pages[$pkey]);
//                }
//                unset($categories[$ckey]);
//            }
//            unset($activities[$akey]);
//        }
//
//        return $nav;
    }

    public function getSubs($sub = null){
        if($sub==null) {
            return [];
        }else{
            foreach ($sub as $s){
                $subs = isset($s["sub"])?$s["sub"]:null;
                $a[] = ["id" => $s["value"]->getId(), "sub" => $this->getSubs($subs)];
            }
            return $a;
        }

    }
    public function getMenu($name)
    {
        $list = $this->listService->getListByName($name);

        $pages = $this->itemRepo->findAllRecords();
        return $this->iteration($list->getItems(), $pages);

    }

    public function iteration($items, $pages)
    {
        $arr = [];
        foreach ($items as $item){
            $structureItem = $this->findStructureItemInList($pages, $item["id"]);

            $id = $structureItem->getId();
            $name = $structureItem->getTitle();
            $urlName = $structureItem->getUrlName();
            $level = ($structureItem->getLevel()==null)?:$structureItem->getLevel()->getId();
            $sub = $this->iteration($item["sub"], $pages);
            $pictogramNav = $structureItem->getAdditionalMeta("pictogramNav");
            $pictogramNavHover = $structureItem->getAdditionalMeta("pictogramNavHover");
            $pictogramLarge = $structureItem->getAdditionalMeta("pictogramLarge");
            $pictogramLargeHover = $structureItem->getAdditionalMeta("pictogramLargeHover");
            $color = $structureItem->getAdditionalMeta("color");
            $imgBanner = $structureItem->getAdditionalMeta("imgBanner");
            $pageType = $structureItem->getAdditionalMeta("pageType");


            $arr[] = new MenuItem(
                                    $id,
                                    $name,
                                    $urlName,
                                    $level,
                                    $sub,
                                    $pictogramNav,
                                    $pictogramNavHover,
                                    $pictogramLarge,
                                    $pictogramLargeHover,
                                    $color,
                                    $imgBanner,
                                    $pageType
                                );
        }
        return $arr;
    }

    /**
     * @param StructureItem[] $pages
     * @param $id
     * @return StructureItem
     */
    public function findStructureItemInList(array $pages, $id)
    {
        foreach ($pages as $page){
            if($page->getId() == $id){
                return $page;
            }
        }
    }

}