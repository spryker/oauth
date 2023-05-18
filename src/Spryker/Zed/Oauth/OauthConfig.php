<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth;

use Spryker\Shared\Oauth\OauthConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @method \Spryker\Shared\Oauth\OauthConfig getSharedConfig()
 */
class OauthConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const GRANT_TYPE_PASSWORD = 'password';

    /**
     * @var string
     */
    public const GRANT_TYPE_REFRESH_TOKEN = 'refresh_token';

    /**
     * @var string
     */
    protected const GENERATED_FULL_FILE_NAME = '/Generated/Zed/Oauth/GlueScopesCache/glue_scopes_cache.yml';

    /**
     * @api
     *
     * @return string
     */
    public function getGeneratedFullFileNameForCollectedScopes(): string
    {
        return APPLICATION_SOURCE_DIR . static::GENERATED_FULL_FILE_NAME;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPublicKeyPath(): string
    {
        return $this->getSharedConfig()->getPublicKeyPath();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPrivateKeyPath(): string
    {
        return $this->getSharedConfig()->getPrivateKeyPath();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getEncryptionKey(): string
    {
        return $this->getSharedConfig()->getEncryptionKey();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getRefreshTokenRetentionInterval(): string
    {
        return $this->getSharedConfig()->getRefreshTokenRetentionInterval();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getRefreshTokenTTL(): string
    {
        return $this->getSharedConfig()->getRefreshTokenTTL();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAccessTokenTTL(): string
    {
        return $this->getSharedConfig()->getAccessTokenTTL();
    }

    /**
     * Specification:
     * - The client secret used to authenticate Oauth client requests, to create use "password_hash('your password', PASSWORD_BCRYPT)".
     *
     * @api
     *
     * @deprecated Use {@link \Spryker\Zed\Oauth\OauthConfig::getClientConfiguration()} instead.
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->get(OauthConstants::OAUTH_CLIENT_SECRET);
    }

    /**
     * Specification:
     * - The client id as is store in spy_oauth_client database table
     *
     * @api
     *
     * @deprecated Use {@link \Spryker\Zed\Oauth\OauthConfig::getClientConfiguration()} instead.
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->get(OauthConstants::OAUTH_CLIENT_IDENTIFIER);
    }

    /**
     * Specification:
     * - Configuration of OAuth client used while requesting access tokens.
     *
     * @api
     *
     * @return array<int, array<string, mixed>>
     */
    public function getClientConfiguration(): array
    {
        return $this->get(OauthConstants::OAUTH_CLIENT_CONFIGURATION);
    }
}
