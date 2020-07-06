<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CmsBundle\Entity\WebUser;

/**
 * ClientToken
 *
 * @ORM\Table(name="web_user_token")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\WebUserTokenRepository")
 */
class WebUserToken
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
     * @var WebUser
     *
     * @ORM\OneToOne(targetEntity="WebUser")
     */
    private $webUser;

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
     * @return WebUserToken
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
     * @return \CmsBundle\Entity\WebUser
     */
    public function getWebUser()
    {
        return $this->webUser;
    }

    /**
     * @param \CmsBundle\Entity\WebUser $webUser
     */
    public function setWebUser($webUser)
    {
        $this->webUser = $webUser;
    }


}

