<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Oauth;

use Codeception\Actor;
use Generated\Shared\DataBuilder\RevokeRefreshTokenRequestBuilder;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\GlueAuthenticationRequestContextTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\RevokeRefreshTokenRequestTransfer;
use Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery;

/**
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 * @method \Spryker\Zed\Oauth\Business\OauthBusinessFactory getFactory()
 *
 * @SuppressWarnings(PHPMD)
 */
class OauthBusinessTester extends Actor
{
    use _generated\OauthBusinessTesterActions;

    /**
     * @var string
     */
    public const GET_METHOD_SCOPE = 'scope:test:read';

    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'Test password';

    /**
     * @var string
     */
    protected const CLIENT_IDENTIFIER = 'test client';

    /**
     * @var string
     */
    protected const CLIENT_SECRET = 'abc123';

    /**
     * @var string
     */
    protected const FAKE_PASSWORD = 'change123';

    public function createRevokeRefreshTokenRequestTransfer(string $customerReference, ?string $refreshToken = null): RevokeRefreshTokenRequestTransfer
    {
        $revokeRefreshTokenRequestTransfer = (new RevokeRefreshTokenRequestBuilder())
            ->seed([RevokeRefreshTokenRequestTransfer::REFRESH_TOKEN => $refreshToken, RevokeRefreshTokenRequestTransfer::CUSTOMER_REFERENCE => $customerReference])
            ->build();

        return $revokeRefreshTokenRequestTransfer;
    }

    public function createCustomerTransfer(): CustomerTransfer
    {
        return $this->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);
    }

    public function getOauthRefreshTokensCount(): int
    {
        return SpyOauthRefreshTokenQuery::create()->count();
    }

    public function deleteAllOauthRefreshTokens(): int
    {
        return SpyOauthRefreshTokenQuery::create()->deleteAll();
    }

    public function createGlueAuthenticationRequestContextTransfer(string $applicationContext): GlueAuthenticationRequestContextTransfer
    {
        $glueAuthenticationRequestContextTransfer = new GlueAuthenticationRequestContextTransfer();
        $glueAuthenticationRequestContextTransfer->setRequestApplication($applicationContext);

        return $glueAuthenticationRequestContextTransfer;
    }

    public function createOauthRequestTransfer(
        string $username,
        string $applicationContext,
        string $grantType
    ): OauthRequestTransfer {
        $oauthRequestTransfer = new OauthRequestTransfer();
        $oauthRequestTransfer
            ->setGrantType($grantType)
            ->setClientId(static::CLIENT_IDENTIFIER)
            ->setClientSecret(static::CLIENT_SECRET)
            ->setUsername($username)
            ->setPassword(static::FAKE_PASSWORD)
            ->setGlueAuthenticationRequestContext(
                (new GlueAuthenticationRequestContextTransfer())
                    ->setRequestApplication($applicationContext),
            );

        return $oauthRequestTransfer;
    }
}
