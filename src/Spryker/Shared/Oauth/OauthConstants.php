<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Oauth;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface OauthConstants
{
    /**
     * Specification:
     *  - Path to public key location
     *
     * @var string
     */
    public const PUBLIC_KEY_PATH = 'PUBLIC_KEY_PATH';

    /**
     * Specification:
     *  - Path to private key location
     *
     * @var string
     */
    public const PRIVATE_KEY_PATH = 'PRIVATE_KEY_PATH';

    /**
     * Specification:
     *  - Encryption key used to encrypt data when build tokens
     *
     * @var string
     */
    public const ENCRYPTION_KEY = 'ENCRYPTION_KEY';

    /**
     * @deprecated Use {@link \Spryker\Shared\Oauth\OauthConstants::OAUTH_CLIENT_CONFIGURATION} instead.
     *
     * Specification:
     *  - The identifier of OAUTH client to use when requesting for access tokens.
     *
     * @api
     *
     * @var string
     */
    public const OAUTH_CLIENT_IDENTIFIER = 'OAUTH_CLIENT_IDENTIFIER';

    /**
     * @deprecated Use {@link \Spryker\Shared\Oauth\OauthConstants::OAUTH_CLIENT_CONFIGURATION} instead.
     *
     * Specification:
     *  - The secret of OAUTH client to use when requesting for access tokens.
     *
     * @api
     *
     * @var string
     */
    public const OAUTH_CLIENT_SECRET = 'OAUTH_CLIENT_SECRET';

    /**
     * Specification:
     *  - Configuration of OAuth client used while requesting access tokens.
     *
     * @api
     *
     * @var string
     */
    public const OAUTH_CLIENT_CONFIGURATION = 'OAUTH:OAUTH_CLIENT_CONFIGURATION';
}
