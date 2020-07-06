<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * StructureComponent
 *
 * @ORM\Table(name="structure_component")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\StructureComponentRepository")
 */
class StructureComponent
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
     * @ORM\ManyToOne(targetEntity="StructureItem" , inversedBy="components")
     * @ORM\JoinColumn(name="structure_item_id", referencedColumnName="id")
     * @MaxDepth(2)
     */
    private $structureItem;

    /**
     * @ORM\ManyToOne(targetEntity="ComponentRegister" , inversedBy="structureComponents")
     * @ORM\JoinColumn(name="component_register_id", referencedColumnName="id")
     * @MaxDepth(2)
     */
    private $componentRegister;

    /**
     * @ORM\Column(name="mobile", type="boolean")
     */
    private $mobile;

    /**
     * @ORM\Column(name="layout", type="string")
     */
    private $layout;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt = null;
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return StructureComponent
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set structureItem
     *
     * @param \CmsBundle\Entity\StructureItem $structureItem
     *
     * @return StructureComponent
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

    /**
     * Set componentRegister
     *
     * @param \CmsBundle\Entity\ComponentRegister $componentRegister
     *
     * @return StructureComponent
     */
    public function setComponentRegister(\CmsBundle\Entity\ComponentRegister $componentRegister = null)
    {
        $this->componentRegister = $componentRegister;

        return $this;
    }

    /**
     * Get componentRegister
     *
     * @return \CmsBundle\Entity\ComponentRegister
     */
    public function getComponentRegister()
    {
        return $this->componentRegister;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    
}
