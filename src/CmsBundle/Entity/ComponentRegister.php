<?php

namespace CmsBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;
/**
 * ComponentRegister
 *
 * @ORM\Table(name="component_register")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\ComponentRegisterRepository")
 */
class ComponentRegister
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
     * @var string
     *
     * @ORM\Column(name="component_name", type="text" , length=255)
     */
    private $componentName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="StructureComponent", mappedBy="componentRegister", cascade={"ALL"})
     * @MaxDepth(2)
     */
    private $structureComponents;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->structureComponents = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set componentName
     *
     * @param string $componentName
     *
     * @return ComponentRegister
     */
    public function setComponentName($componentName)
    {
        $this->componentName = $componentName;

        return $this;
    }

    /**
     * Get componentName
     *
     * @return string
     */
    public function getComponentName()
    {
        return $this->componentName;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return ComponentRegister
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
     * Add structureComponent
     *
     * @param \CmsBundle\Entity\StructureComponent $structureComponent
     *
     * @return ComponentRegister
     */
    public function addStructureComponent(\CmsBundle\Entity\StructureComponent $structureComponent)
    {
        $this->structureComponents[] = $structureComponent;

        return $this;
    }

    /**
     * Remove structureComponent
     *
     * @param \CmsBundle\Entity\StructureComponent $structureComponent
     */
    public function removeStructureComponent(\CmsBundle\Entity\StructureComponent $structureComponent)
    {
        $this->structureComponents->removeElement($structureComponent);
    }

    /**
     * Get structureComponents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStructureComponents()
    {
        return $this->structureComponents;
    }
}
