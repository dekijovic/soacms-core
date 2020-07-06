<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CmsBundle\Entity\User;

/**
 * UserToken
 *
 * @ORM\Table(name="user_token")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\UserTokenRepository")
 */
class UserToken
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="refresh_token", type="string", length=255)
     */
    private $refreshToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="refresh_token_expire", type="datetime")
     */
    private $refreshTokenExpire;

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
     * Set refreshToken
     *
     * @param string $refreshToken
     *
     * @return UserToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return \DateTime
     */
    public function getRefreshTokenExpire()
    {
        return $this->refreshTokenExpire;
    }

    /**
     * @param \DateTime $refreshTokenExpire
     */
    public function setRefreshTokenExpire($refreshTokenExpire)
    {
        $this->refreshTokenExpire = $refreshTokenExpire;
    }

    /**
     * @return \CmsBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \CmsBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    
    
}



