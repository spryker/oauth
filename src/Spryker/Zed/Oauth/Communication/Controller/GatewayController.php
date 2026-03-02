<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Communication\Controller;

use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Generated\Shared\Transfer\RevokeRefreshTokenRequestTransfer;
use Generated\Shared\Transfer\RevokeRefreshTokenResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Spryker\Zed\Oauth\Business\OauthFacadeInterface getFacade()
 * @method \Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    public function processAccessTokenRequestAction(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer
    {
        return $this->getFacade()->processAccessTokenRequest($oauthRequestTransfer);
    }

    public function validateAccessTokenAction(
        OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
    ): OauthAccessTokenValidationResponseTransfer {
        return $this->getFacade()->validateAccessToken($authAccessTokenValidationRequestTransfer);
    }

    public function revokeRefreshTokenAction(RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer): RevokeRefreshTokenResponseTransfer
    {
        return $this->getFacade()->revokeRefreshToken($revokeRefreshTokenRequestTransfer);
    }

    public function revokeAllRefreshTokensAction(RevokeRefreshTokenRequestTransfer $revokeRefreshTokenRequestTransfer): RevokeRefreshTokenResponseTransfer
    {
        return $this->getFacade()->revokeAllRefreshTokens($revokeRefreshTokenRequestTransfer);
    }
}
