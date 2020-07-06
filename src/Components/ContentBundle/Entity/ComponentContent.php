<?php

namespace Components\ContentBundle\Entity;

use CmsBundle\Entity\StructureComponent;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentContent
 *
 * @ORM\Table(name="component_content")
 * @ORM\Entity(repositoryClass="Components\ContentBundle\Repository\ComponentContentRepository")
 * @ExclusionPolicy("all")
 */
class ComponentContent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var StructureComponent
     *
     * @ORM\OneToOne(targetEntity="CmsBundle\Entity\StructureComponent")
     * @ORM\JoinColumn(name="structure_component_id", referencedColumnName="id", nullable=false)
     * @MaxDepth(1)
     * @Expose
     */
    private $structureComponent;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Expose
     */
    private $content;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return ComponentContent
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set structureComponent.
     *
     * @param \stdClass $structureComponent
     *
     * @return ComponentContent
     */
    public function setStructureComponent($structureComponent)
    {
        $this->structureComponent = $structureComponent;

        return $this;
    }

    /**
     * Get structureComponent.
     *
     * @return \stdClass
     */
    public function getStructureComponent()
    {
        return $this->structureComponent;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return ComponentContent
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return ComponentContent
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
