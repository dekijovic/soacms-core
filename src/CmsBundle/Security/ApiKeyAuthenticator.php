<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/9/2018
 * Time: 6:30 PM
 */

namespace CmsBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface
{
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
//        var_dump($token); die();
        // TODO: Implement authenticateToken() method.
        return $token;
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        // TODO: Implement supportsToken() method.
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;

    }

    public function createToken(Request $request, $providerKey)
    {
//        $token = $request->headers->get("Access-Token");



        return new PreAuthenticatedToken(
            'anon.',
            null,
            $providerKey
        );
        

        // TODO: Implement createToken() method.
        return null;
    }

}