<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\UserRepository")
 * @ExclusionPolicy("all")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"listPages", "onePage"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Groups({"listPages", "onePage"})
     * @Expose
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     * @Groups({"listPages", "onePage"})
     * @Expose
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Groups({"listPages", "onePage"})
     * @Expose
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Expose
     */
    private $deletedAt;

    /**
     * @var StructureItem[]
     * @ORM\OneToMany(targetEntity="StructureItem", mappedBy="creatorUser")
     * @MaxDepth(1)
     */
    private $structureItems;

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
     * Set name
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set lastName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return User
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
     * @param \CmsBundle\Entity\StructureItem $structureItem
     *
     * @return StructureItem
     */
    public function addStructureItem(\CmsBundle\Entity\StructureItem $structureItem)
    {
        $this->structureItems[] = $structureItem;

        return $this;
    }

    /**
     * Remove structureLocale
     *
     * @param \CmsBundle\Entity\StructureItem $structureItem
     */
    public function removeStructureItem(\CmsBundle\Entity\StructureItem $structureItem)
    {
        $this->structureItems->removeElement($structureItem);
    }

    /**
     * Get structureItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStructureItems()
    {
        return $this->structureItems;
    }

    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    public function setPassword($password){

        $this->password = $password;

        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}
