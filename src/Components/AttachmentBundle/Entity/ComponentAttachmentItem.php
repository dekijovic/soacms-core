<?php

namespace Components\AttachmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * ComponentAttachmentItem
 *
 * @ORM\Table(name="component_attachment_items")
 * @ORM\Entity(repositoryClass="Components\AttachmentBundle\Repository\ComponentAttachmentItemRepository")
 */
class ComponentAttachmentItem
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
     * @var ComponentAttachmentStore
     *
     * @ORM\ManyToOne(targetEntity="ComponentAttachmentStore", inversedBy="attachments")
     * @MaxDepth(1)
     * @Expose
     */
    private $attachmentStore;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedBy", type="datetime")
     */
    private $deletedBy;



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
     * Set attachmentStore.
     *
     * @param ComponentAttachmentStore $attachmentStore
     *
     * @return ComponentAttachmentItem
     */
    public function setAttachmentStore(ComponentAttachmentStore $attachmentStore)
    {
        $this->attachmentStore = $attachmentStore;

        return $this;
    }

    /**
     * Get attachmentStore.
     *
     * @return ComponentAttachmentStore
     */
    public function getAttachmentStore()
    {
        return $this->attachmentStore;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return ComponentAttachmentItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set deletedBy.
     *
     * @param \DateTime $deletedBy
     *
     * @return ComponentAttachmentItem
     */
    public function setDeletedBy($deletedBy)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * Get deletedBy.
     *
     * @return \DateTime
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return ComponentAttachmentItem
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
     * Set type.
     *
     * @param string $type
     *
     * @return ComponentAttachmentItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
