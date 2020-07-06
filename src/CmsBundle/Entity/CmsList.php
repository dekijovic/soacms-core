<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List
 *
 * @ORM\Table(name="lists")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\CmsListRepository")
 */
class CmsList
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
     * @var CmsListType
     * @ORM\ManyToOne(targetEntity="CmsListType", inversedBy="lists")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="items", type="json_array")
     */
    private $items;

    /**
     * @var array
     *
     * @ORM\Column(name="custom_data", type="json_array")
     */
    private $customData;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CmsList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * @param array $customData
     */
    public function setCustomData($customData)
    {
        $this->customData = $customData;
    }

    /**
     * @return CmsListType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param CmsListType $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
}

