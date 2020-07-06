<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/13/2018
 * Time: 2:23 AM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\User;
use CmsBundle\Entity\WebUser;
use CmsBundle\Repository\UserRepository;
use CmsBundle\Repository\WebUserRepository;

class UserService
{

    public function __construct(UserRepository $userRepository, WebUserRepository $webUserRepository)
    {
        $this->userRepo = $userRepository;
        $this->webUserRepo = $webUserRepository;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->userRepo->findAll();
    }

    /**
     * @return array
     */
    public function getWebUsers()
    {
        return $this->webUserRepo->findAll();
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getOneUser($id)
    {
        return $this->userRepo->find($id);
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getOneWebUser($id)
    {
        return $this->webUserRepo->find($id);
    }

    /**
     * @return User
     */
    public function createUser()
    {
        $user = new User();
        $user->setEmail();
        $user->setFullName();
        $user->setPassword();
        $user->setUsername();

        $this->userRepo->save($user);
        return $user;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function updateUser($id)
    {
        $user = $this->getOneUser($id);
        $user->setEmail();
        $user->setFullName();
        $user->setPassword();
        $user->setUsername();

        $this->userRepo->save($user);
        return $user;
    }

    /**
     * @param $id
     * @throws \CmsBundle\Exceptions\MethodNotFoundException
     * @throws \CmsBundle\Exceptions\NotFoundObjectException
     */
    public function deleteUser($id)
    {
        $this->userRepo->softDelete($id);
    }

    /**
     * @return User
     */
    public function createWebUser()
    {
        $user = new WebUser();
        $user->setEmail();
        $user->SetName();
        $user->setPassword();
        $user->setLastName();

        $this->webUserRepo->save($user);
        return $user;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function updateWebUser($id)
    {
        $user = $this->getOneUser($id);
        $user->setEmail();
        $user->setFullName();
        $user->setPassword();
        $user->setUsername();

        $this->webUserRepo->save($user);
        return $user;
    }

    /**
     * @param $id
     * @throws \CmsBundle\Exceptions\MethodNotFoundException
     * @throws \CmsBundle\Exceptions\NotFoundObjectException
     */
    public function deleteWebUser($id)
    {
        $this->webUserRepo->softDelete($id);
    }
}