<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Communication\Plugin\Oauth;

use Generated\Shared\Transfer\GlueAuthenticationRequestContextTransfer;
use Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oauth\Business\Model\League\Grant\RefreshTokenGrantType;
use Spryker\Zed\Oauth\OauthConfig;
use Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRequestGrantTypeConfigurationProviderPluginInterface;

/**
 * @method \Spryker\Zed\Oauth\Business\OauthFacadeInterface getFacade()
 * @method \Spryker\Zed\Oauth\OauthConfig getConfig()
 */
class UserRefreshTokenOauthRequestGrantTypeConfigurationProviderPlugin extends AbstractPlugin implements OauthRequestGrantTypeConfigurationProviderPluginInterface
{
    /**
     * @uses \Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\ApplicationIdentifierRequestBuilderPlugin::GLUE_BACKEND_API_APPLICATION
     */
    protected const string GLUE_BACKEND_API_APPLICATION = 'GLUE_BACKEND_API_APPLICATION';

    /**
     * {@inheritDoc}
     * - Applies to the `refresh_token` grant requested by the Backend API application.
     *
     * @api
     */
    public function isApplicable(
        OauthRequestTransfer $oauthRequestTransfer,
        GlueAuthenticationRequestContextTransfer $glueAuthenticationRequestContextTransfer
    ): bool {
        return $oauthRequestTransfer->getGrantType() === OauthConfig::GRANT_TYPE_REFRESH_TOKEN
            && $glueAuthenticationRequestContextTransfer->getRequestApplication() === static::GLUE_BACKEND_API_APPLICATION;
    }

    /**
     * {@inheritDoc}
     * - Returns the `refresh_token` grant configuration.
     *
     * @api
     */
    public function getGrantTypeConfiguration(): OauthGrantTypeConfigurationTransfer
    {
        return (new OauthGrantTypeConfigurationTransfer())
            ->setIdentifier(OauthConfig::GRANT_TYPE_REFRESH_TOKEN)
            ->setFullyQualifiedClassName(RefreshTokenGrantType::class);
    }
}
