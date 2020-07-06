<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List
 *
 * @ORM\Table(name="lists_type")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\CmsListTypeRepository")
 */
class CmsListType
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var CmsList[]
     * @ORM\OneToMany(targetEntity="CmsList", mappedBy="type", cascade={"ALL"})
     */
    private $lists;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lists = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return CmsList[]
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param CmsList $list
     */
    public function addList(CmsList $list)
    {
        $this->lists[] = $list;
    }

    /**
     * Remove structureLocale
     *
     * @param CmsList $list
     */
    public function removeList(CmsList $list)
    {
        $this->lists->removeElement($list);
    }


}

