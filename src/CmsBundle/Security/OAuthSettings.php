<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 1/10/2018
 * Time: 10:54 PM
 */

namespace CmsBundle\Security;


class OAuthSettings
{
    const GRANT_TYPE = "grant_type";

    const GRANT_TYPE_IMPLICIT = "implicit";

    const GRANT_TYPE_PASSWORD = "password";

    const GRANT_TYPE_REFRESH_TOKEN = "refresh_token";

    const GRANT_TYPE_CLIENT_CREDENTIALS = "client_credentials";

    const GRANT_TYPE_AUTHORIZATION_CODE = "authorization_code";

    const TOKEN_EXPIRE = 600;

    const REFRESH_TOKEN_EXPIRE = 3600;

    const GRUNT_TYPES = [
        self::GRANT_TYPE_IMPLICIT,
        self::GRANT_TYPE_CLIENT_CREDENTIALS,
        self::GRANT_TYPE_AUTHORIZATION_CODE
    ];
}