<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/12/2018
 * Time: 9:58 PM
 */

namespace CmsBundle\RequestModel;


class Credentials
{

    private $username;

    private $email;

    private $refreshToken;

    private $grantType;

    private $password;

    public function __construct($array)
    {
        $this->username = isset($array["username"])?$array["username"]:null;
        $this->email = isset($array["email"])?$array["email"]:null;
        $this->refreshToken = isset($array["refresh_token"])?$array["refresh_token"]:null;
        $this->grantType = isset($array["grant_type"])?$array["grant_type"]:null;
        $this->password = isset($array["password"])?$array["password"]:null;
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return null
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return null
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

}