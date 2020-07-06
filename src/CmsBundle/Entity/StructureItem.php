<?php

namespace CmsBundle\Entity;

use Doctrine\DBAL\Types\JsonType;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * Page
 *
 * @ORM\Table(name="structure_items")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\StructureItemRepository")
 * @ExclusionPolicy("all")
 */
class StructureItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"listPages", "onePage", "mainmanu"})
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"listPages", "onePage", "mainmanu"})
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url_name", type="string", length=255)
     * @Groups({"listPages", "onePage","mainmanu"})
     * @Expose
     */
    private $urlName;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Groups({"listPages", "onePage"})
     * @Expose
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime")
     * @Expose
     */
    private $modifiedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="structureItems")
     * @Groups({"listPages", "onePage"})
     * @Expose
     * @MaxDepth(2)
     */
    private $creatorUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Expose
     */
    private $deletedAt;

    /**
     * @var StructureLocale[]
     * @ORM\OneToMany(targetEntity="StructureLocale", mappedBy="structureItem", cascade={"ALL"})
     * @Groups({"onePage"})
     * @Expose
     */
    private $structureLocales;

    /**
     * @var StructureLevel
     * @ORM\ManyToOne(targetEntity="StructureLevel", inversedBy="structureItem")
     * @Groups({"listPages", "onePage"})
     * @Expose
     * @MaxDepth(2)
     */
    private $level;

    /**
     * @var StructureItem
     * @ORM\ManyToOne(targetEntity="StructureItem")
     * @ORM\JoinColumn(name="parent_structure_id", referencedColumnName="id")
     * @Groups({"list", "one"})
     * @Expose
     * @MaxDepth(1)
     */
    private $parentStructure;


    /**
     * @ORM\OneToMany(targetEntity="StructureComponent", mappedBy="structureItem", cascade={"ALL"})
     * @Groups({"onePage"})
     * @Expose
     * @MaxDepth(3)
     */
    private $components;

    /**
     * @var JsonType
     * @ORM\Column(name="additional_meta", type="json", nullable=true)
     * @Groups({"listPages", "onePage", "mainmanu"})
     * @Expose
     */
    private $additionalMeta;

    /**
     * @var JsonType
     *
     * @ORM\Column(name="component_stack", type="json", nullable=true)
     * @Groups({"onePage"})
     * @Expose
     */
    private $componentStack = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->structureLocales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->components = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return StructureItem
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
     * Set urlName
     *
     * @param string $urlName
     *
     * @return StructureItem
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return StructureItem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return StructureItem
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set createdUser
     *
     * @param User $creatorUser
     *
     * @return StructureItem
     */
    public function setCreatorUser(User $creatorUser)
    {
        $this->creatorUser = $creatorUser;

        return $this;
    }

    /**
     * Get createdUser
     *
     * @return User
     */
    public function getCreatorUser()
    {
        return $this->creatorUser;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return StructureItem
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
     * Add structureLocales
     *
     * @param \CmsBundle\Entity\StructureLocale $structureLocale
     *
     * @return StructureItem
     */
    public function addStructureLocale(\CmsBundle\Entity\StructureLocale $structureLocale)
    {
        $this->structureLocales[] = $structureLocale;

        return $this;
    }

    /**
     * Remove structureLocale
     *
     * @param \CmsBundle\Entity\StructureLocale $structureLocale
     */
    public function removeStructureLocale(\CmsBundle\Entity\StructureLocale $structureLocale)
    {
        $this->structureLocales->removeElement($structureLocale);
    }

    /**
     * Get structureLocales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStructureLocales()
    {
        return $this->structureLocales;
    }

    /**
     * Set level
     *
     * @param \CmsBundle\Entity\StructureLevel $level
     *
     * @return StructureItem
     */
    public function setLevel(\CmsBundle\Entity\StructureLevel $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \CmsBundle\Entity\StructureLevel
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set parentStructure
     *
     * @param \CmsBundle\Entity\StructureItem $parentStructure
     *
     * @return StructureItem
     */
    public function setParentStructure(\CmsBundle\Entity\StructureItem $parentStructure = null)
    {
        $this->parentStructure = $parentStructure;

        return $this;
    }

    /**
     * Get parentStructure
     *
     * @return \CmsBundle\Entity\StructureItem
     */
    public function getParentStructure()
    {
        return $this->parentStructure;
    }

    /**
     * Add component
     *
     * @param \CmsBundle\Entity\StructureComponent $component
     *
     * @return StructureItem
     */
    public function addComponent(\CmsBundle\Entity\StructureComponent $component)
    {
        $this->components[] = $component;

        return $this;
    }

    /**
     * Remove component
     *
     * @param \CmsBundle\Entity\StructureComponent $component
     */
    public function removeComponent(\CmsBundle\Entity\StructureComponent $component)
    {
        $this->components->removeElement($component);
    }

    /**
     * Get components
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @return JsonType
     */
    public function getComponentStack()
    {
        return $this->componentStack;
    }

    /**
     * @param array $componentStack
     */
    public function setComponentStack(array $componentStack)
    {
        $this->componentStack = $componentStack;
    }

    /**
     * @return JsonType
     */
    public function getAdditionalMeta($key = null)
    {
        if($key !== null){
            if(isset($this->additionalMeta[$key])){
                return $this->additionalMeta[$key];
            }else{
                return null;
            }
        }else{
            return $this->additionalMeta;
        }
    }

    /**
     * @param $additionalMeta
     */
    public function setAdditionalMeta($additionalMeta)
    {
        $this->additionalMeta = $additionalMeta;
    }


}
