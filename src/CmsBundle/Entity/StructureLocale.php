<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="structure_locale")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\StructureLocaleRepository")
 */
class StructureLocale
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;
    /**
     * @ORM\ManyToOne(targetEntity="StructureItem", inversedBy="structureLocales")
     */
    private $structureItem;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text" , length=255)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text" , nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="text", length=255, nullable=true)
     */
    private $seoTitle;
    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", length=255, nullable=true)
     */
    private $seoDescription;
    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="text", length=255, nullable=true)
     */
    private $seoKeywords;
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return StructureLocale
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return StructureLocale
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return StructureLocale
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return StructureLocale
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return StructureLocale
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set language
     *
     * @param \CmsBundle\Entity\Language $language
     *
     * @return StructureLocale
     */
    public function setLanguage(\CmsBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \CmsBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set structureItem
     *
     * @param \CmsBundle\Entity\StructureItem $structureItem
     *
     * @return StructureLocale
     */
    public function setStructureItem(\CmsBundle\Entity\StructureItem $structureItem = null)
    {
        $this->structureItem = $structureItem;

        return $this;
    }

    /**
     * Get structureItem
     *
     * @return \CmsBundle\Entity\StructureItem
     */
    public function getStructureItem()
    {
        return $this->structureItem;
    }
}
