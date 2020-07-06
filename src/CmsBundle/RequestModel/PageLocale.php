<?php

namespace CmsBundle\RequestModel;

use JMS\Serializer\Annotation as Serializer;

class PageLocale
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $seoTitle;
    /**
     * @var string
     */
    private $seoKeywords;

    /**
     * @var string
     */
    private $seoDescription;

    /**
     * @var int
     */
    private $languageId;

    /**
     * @param $title
     * @param $languageId
     * @param string $content
     * @param string $seoTitle
     * @param string $seoKeywords
     * @param string $seoDescription
     * @return PageLocale
     */
    public static function initialize($title, $languageId, $content = '', $seoTitle = '', $seoKeywords = '', $seoDescription = '')
    {

        return new PageLocale($title, $languageId, $content, $seoTitle, $seoKeywords, $seoDescription);
    }

    private function __construct($title, $languageId, $content, $seoTitle, $seoKeywords, $seoDescription)
    {
        $this->title =$title;

        $this->languageId = $languageId;

        $this->content = $content;

        $this->seoTitle = $seoTitle;

        $this->seoDescription = $seoDescription;

        $this->seoKeywords = $seoKeywords;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }



}