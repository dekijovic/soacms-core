<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/11/2018
 * Time: 1:05 AM
 */

namespace CmsBundle\Services;


use CmsBundle\Entity\ClientApp;
use CmsBundle\Entity\User;
use CmsBundle\Entity\UserToken;
use CmsBundle\Entity\WebUser;
use CmsBundle\Entity\WebUserToken;
use CmsBundle\Exceptions\BadCredentialsLoginException;
use CmsBundle\Repository\ClientAppRepository;
use CmsBundle\Repository\UserRepository;
use CmsBundle\Repository\UserTokenRepository;
use CmsBundle\Repository\WebUserRepository;
use CmsBundle\Repository\WebUserTokenRepository;
use CmsBundle\RequestModel\Credentials;
use CmsBundle\Security\OAuthSettings;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityService
{

    /** @var ClientAppRepository  */
    private $clientAppRepo;

    /** @var WebUserTokenRepository  */
    private $webUserTokenRepo;

    /** @var UserTokenRepository  */
    private $userTokenRepo;

    /** @var WebUserRepository  */
    private $webUserRepo;

    /** @var UserRepository  */
    private $userRepo;

    /** @var JWTEncoderInterface  */
    private $jwt;

    /**
     * SecurityService constructor.
     * @param ClientAppRepository $clientAppRepository
     * @param WebUserTokenRepository $webUserTokenRepository
     * @param UserTokenRepository $userTokenRepository
     * @param WebUserRepository $webUserRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ClientAppRepository $clientAppRepository,
                                WebUserTokenRepository $webUserTokenRepository,
                                UserTokenRepository $userTokenRepository,
                                UserRepository $userRepository,
                                WebUserRepository $webUserRepository,
                                JWTEncoderInterface $JWTEncoder)
    {
        $this->clientAppRepo = $clientAppRepository;
        $this->webUserTokenRepo = $webUserTokenRepository;
        $this->userTokenRepo = $userTokenRepository;
        $this->webUserRepo = $webUserRepository;
        $this->userRepo = $userRepository;
        $this->jwt = $JWTEncoder;
    }

    /**
     * @param $name
     * @param null $gruntType
     * @param null $data
     * @return Object
     */
    public function createClientApp($name, $gruntType = null, $data = null)
    {

        if($gruntType ===null){
            $gruntType = OAuthSettings::GRANT_TYPE_IMPLICIT;
        }
        else{
            $gruntType = OAuthSettings::GRUNT_TYPES[$gruntType];
        }

        if($data ===null) {
            if ($gruntType == OAuthSettings::GRANT_TYPE_IMPLICIT) {
                $data = [
                    "clientId" => uniqid("client-app", true)
                ];
            }
        }
        $clientApp = new ClientApp();
        $clientApp->setName($name);
        $clientApp->setGrantType($gruntType);
        $clientApp->setKeyData($data);

        return $this->clientAppRepo->save($clientApp);
    }

    /**
     * @param Credentials $credentials
     * @throws BadCredentialsLoginException
     * @return array
     */
    public function userLogin(Credentials $credentials)
    {

        if ($credentials->getGrantType() == OAuthSettings::GRANT_TYPE_PASSWORD) {
            $user = $this->gruntTypePassword($credentials);
        }elseif($credentials->getGrantType() == OAuthSettings::GRANT_TYPE_REFRESH_TOKEN) {
            $user = $this->gruntTypeRefreshToken($credentials);
        }else{
            throw new BadCredentialsLoginException("Grant type invalid");
        }

        
        return $this->generateTokens($user);

    }

    /**
     * @param Credentials $credentials
     * @return null|object
     * @throws BadCredentialsLoginException
     */
    public function gruntTypePassword(Credentials $credentials){
        $user = $this->userRepo->findOneBy(["username"=>$credentials->getUsername(), "password"=>$credentials->getPassword()]);

        if(!$user instanceof UserInterface) {
            throw new BadCredentialsLoginException("Username or password are invalid");

        }
        return $user;
    }

    /**
     * @param Credentials $credentials
     * @return User
     * @throws BadCredentialsLoginException
     */
    public function gruntTypeRefreshToken(Credentials $credentials){

        /** @var UserToken $userToken */
        $userToken = $this->userTokenRepo->findOneBy(["refreshToken"=>$credentials->getRefreshToken()]);
        if(!$userToken instanceof UserToken){
            throw new BadCredentialsLoginException("Refresh token invalid");
        }
        $time = new \DateTime();
        if($time->getTimestamp() > $userToken->getRefreshTokenExpire()->getTimestamp()){
            throw new BadCredentialsLoginException("Refresh token expired");
        }

        return $userToken->getUser();

    }

    /**
     * @param UserInterface $user
     * @return array
     */
    public function generateTokens(UserInterface $user)
    {
        
        $accessToken = $this->jwt->encode(["name" => $user->getUsername(), "id"=>$user->getId(), "roles"=>$user->getRoles()]);
        $refreshToken = $this->createUserRefreshToken($user);

        $data = [
            "header_name"=>"Authorization",
            "token_type"=>"Bearer",
            "access_token"=>$accessToken,
            "refresh_token"=>$refreshToken,
            "roles"=>$user->getRoles(),
            "access_token_expire" =>300
            
        ];
        return $data;
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function createUserRefreshToken(UserInterface $user)
    {
        $time = new \DateTime();
        $time->add(new \DateInterval("PT2H"));
         $refreshToken = base64_encode($user->getUsername().".".$user->getId().".".$time->getTimestamp());
        if($user instanceof User) {

            $userToken = $this->userTokenRepo->findOneBy(["user"=>$user]);
            if($userToken == null) {
                $userToken = new UserToken();
                $userToken->setUser($user);
            }
            $repo = $this->userTokenRepo;
        }elseif ($user instanceof WebUser){

            $userToken = $this->webUserTokenRepo->findOneBy(["webUser"=>$user]);
            if($userToken == null) {
                $userToken = new WebUserToken();
                $userToken->setWebUser($user);
            }
            $repo = $this->userTokenRepo;
        }
        $userToken->setRefreshToken($refreshToken);
        $userToken->setRefreshTokenExpire($time);
        $repo->save($userToken);


        return $refreshToken;
    }
}