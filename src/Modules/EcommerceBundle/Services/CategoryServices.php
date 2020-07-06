<?php

namespace Modules\EcommerceBundle\Services;


use CmsBundle\RequestModel\Category;
use Modules\EcommerceBundle\Entity\EcommerceCategory;
use Modules\EcommerceBundle\Repository\EcommerceCategoryRepository;

class CategoryServices
{
    
    /** @var EcommerceCategoryRepository  */
    private $repo;
    
    public function __construct(EcommerceCategoryRepository $categoryRepository)
    {
        $this->repo = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->repo->findAllRecords();
    }

    public function getCategory($id)
    {
        return $this->repo->find($id);
    }

    public function createCategory(Category $category)
    {
        $ecategory = new EcommerceCategory();
    }
}