<?php

namespace Components\AttachmentBundle\Entity;

use CmsBundle\Entity\StructureComponent;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentAttachmentStore
 *
 * @ORM\Table(name="component_attachment_stores")
 * @ORM\Entity(repositoryClass="Components\AttachmentBundle\Repository\ComponentAttachmentStoreRepository")
 * @ExclusionPolicy("all")
 */
class ComponentAttachmentStore
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
     * @var ComponentAttachmentItem[]
     * @ORM\OneToMany(targetEntity="ComponentAttachmentItem", mappedBy="attachmentStore")
     * @MaxDepth(2)
     * @Expose
     */
    private $attachments;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     * @Expose
     */
    private $active;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
     * Set name.
     *
     * @param string $name
     *
     * @return ComponentAttachmentStore
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return ComponentAttachmentStore
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return StructureComponent
     */
    public function getStructureComponent()
    {
        return $this->structureComponent;
    }

    /**
     * @param StructureComponent $structureComponent
     */
    public function setStructureComponent($structureComponent)
    {
        $this->structureComponent = $structureComponent;
    }

    /**
     * @return ComponentAttachmentItem[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param ComponentAttachmentItem
     */
    public function addAttachment(ComponentAttachmentItem $attachments)
    {
        $this->attachments[] = $attachments;
    }

    /**
     * Remove Attachment
     *
     * @param ComponentAttachmentItem $attachments
     */
    public function removeAttachment(ComponentAttachmentItem $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

}
