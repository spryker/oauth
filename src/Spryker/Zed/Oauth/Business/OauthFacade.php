<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business;

use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer;
use Generated\Shared\Transfer\OauthClientTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Generated\Shared\Transfer\OauthScopeTransfer;
use Generated\Shared\Transfer\RevokeRefreshTokenRequestTransfer;
use Generated\Shared\Transfer\RevokeRefreshTokenResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\Oauth\Business\OauthBusinessFactory getFactory()
 * @method \Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface getRepository()
 */
class OauthFacade extends AbstractFacade implements OauthFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthRequestTransfer $oauthRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer
    {
        return $this->getFactory()->createAccessTokenRequestExecutor()->executeByRequest($oauthRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer
     */
    public function validateAccessToken(
        OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
    ): OauthAccessTokenValidationResponseTransfer {
        return $this->getFactory()->createAccessTokenReader()->validate($authAccessTokenValidationRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthScopeTransfer $oauthScopeTransfer
     *
     * @return \Generated\Shared\Transfer\OauthScopeTransfer
     */
    public function saveScope(OauthScopeTransfer $oauthScopeTransfer): OauthScopeTransfer
    {
        return $this->getFactory()->createOauthScopeWriter()->save($oauthScopeTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed in the next major.
     *
     * @param \Generated\Shared\Transfer\OauthClientTransfer $oauthClientTransfer
     *
     * @return \Generated\Shared\Transfer\OauthClientTransfer
     */
    public function saveClient(OauthClientTransfer $oauthClientTransfer): OauthClientTransfer
    {
        return $this->getFactory()->createOauthClientWriter()->save($oauthClientTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthClientTransfer $oauthClientTransfer
     *
     * @return \Generated\Shared\Transfer\OauthClientTransfer|null
     */
    public function findClientByIdentifier(OauthClientTransfer $oauthClientTransfer): ?OauthClientTransfer
    {
        return $this->getFactory()->createOauthClientReader()->findClientByIdentifier($oauthClientTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthScopeTransfer $oauthScopeTransfer
     *
     * @return \Generated\Shared\Transfer\OauthScopeTransfer|null
     */
    public function findScopeByIdentifier(OauthScopeTransfer $oauthScopeTransfer): ?OauthScopeTransfer
    {
        return $this->getFactory()->createOauthScopeReader()->findScopeByIdentifier($oauthScopeTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string> $customerScopes
     *
     * @return array<\Generated\Shared\Transfer\OauthScopeTransfer>
     */
    public function getScopesByIdentifiers(array $customerScopes): array
    {
        return $this->getFactory()->createOauthScopeReader()->getScopesByIdentifiers($customerScopes);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return void
     */
    public function installOauthClient(): void
    {
        $this->getFactory()
            ->createOauthClientInstaller()
            ->install();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RevokeRefreshTokenResponseTransfer
     */
    public function revokeRefreshToken(RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer): RevokeRefreshTokenResponseTransfer
    {
        return $this->getFactory()->createOauthRefreshTokenRevoker()->revokeRefreshToken($revokeRefreshTokenRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RevokeRefreshTokenResponseTransfer
     */
    public function revokeAllRefreshTokens(RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer): RevokeRefreshTokenResponseTransfer
    {
        return $this->getFactory()->createOauthRefreshTokenRevoker()->revokeAllRefreshTokens($revokeRefreshTokenRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return int|null
     */
    public function deleteExpiredRefreshTokens(): ?int
    {
        return $this->getFactory()->createOauthExpiredRefreshTokenRemover()->deleteExpiredRefreshTokens();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return void
     */
    public function generateScopeCollection(): void
    {
        $this->getFactory()->createScopeCacheCollector()->collect();
    }
}
