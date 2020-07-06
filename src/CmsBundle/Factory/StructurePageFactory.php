<?php
namespace CmsBundle\Factory;
use CmsBundle\Exceptions\NotFoundObjectException;
use CmsBundle\RequestModel\Activity;
use CmsBundle\RequestModel\Category;
use CmsBundle\RequestModel\Page;
use CmsBundle\RequestModel\PageLocale;
use CmsBundle\RequestModel\Product;
use CmsBundle\Registry\Constants;


class StructurePageFactory
{

    public function getStructure($data)
    {
        if(!$data->level){
            throw new NotFoundObjectException("Invalid Level Id");
        }
        switch ($data->level){
            case Constants::ACTIVITY:
                return $this->createActivity($data);
            case Constants::CATEGORY:
                return $this->createCategory($data);
            case Constants::PAGE:
                return $this->createPage($data);
            case Constants::PRODUCT:
                return $this->createProduct($data);
            default:
                throw new NotFoundObjectException("Invalid Level ID");
        }
    }

    /**
     * @param $data
     * @return Page
     * @throws \CmsBundle\Exceptions\InvalidParameterException
     */
    public function createPage($data)
    {
        $data->page_locale = $this->createPageLocale($data->page_locale);
        return Page::initialize($data);
    }

    /**
     * @param $data
     * @return Category
     */
    public function createCategory($data)
    {
        $data->page_locale = $this->createPageLocale($data->page_locale);
        return Category::initialize($data);
    }

    /**
     * @param $data
     * @return Activity|Page
     */
    public function createActivity($data)
    {
        $data->page_locale = $this->createPageLocale($data->page_locale);
        return Activity::initialize($data);
    }

    /**
     * @param $data
     * @return Page|Product
     */
    public function createProduct($data)
    {
        $data->page_locale = $this->createPageLocale($data->page_locale);
        return Product::initialize($data);
    }

    /**
     * @param $data
     * @return array
     */
    private function createPageLocale($pageLocale)
    {
        $arrPageLocale = [];
        foreach($pageLocale as $page){
            $arrPageLocale[] = PageLocale::initialize(
                $page->title,
                $page->language_id,
                $page->content,
                $page->seo_title,
                $page->seo_description,
                $page->seo_keywords
            );
        }
        return $arrPageLocale;
    }
}