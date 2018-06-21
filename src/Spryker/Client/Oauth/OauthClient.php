<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Oauth;

use Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer;
use Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\Oauth\OauthFactory getFactory()
 */
class OauthClient extends AbstractClient implements OauthClientInterface
{
    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\OauthRequestTransfer $oauthRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer
    {
        return $this->getFactory()->createOauthStub()->processAccessTokenRequest($oauthRequestTransfer);
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\OauthAccessTokenValidationResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function validateAccessToken(OauthAccessTokenValidationRequestTransfer $authAccessTokenValidationRequestTransfer): OauthAccessTokenValidationResponseTransfer
    {
        return $this->getFactory()->createAccessTokenValidator()->validate($authAccessTokenValidationRequestTransfer);
    }
}
