<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Communication\Plugin\Oauth;

use Generated\Shared\Transfer\GlueAuthenticationRequestContextTransfer;
use Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Spryker\Glue\Kernel\AbstractPlugin;
use Spryker\Zed\Oauth\Business\Model\League\Grant\UserPasswordGrantTypeBuilder;
use Spryker\Zed\Oauth\OauthConfig;
use Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRequestGrantTypeConfigurationProviderPluginInterface;

/**
 * @method \Spryker\Zed\Oauth\OauthConfig getConfig()
 * @method \Spryker\Zed\Oauth\Business\OauthFacadeInterface getFacade()
 */
class UserPasswordOauthRequestGrantTypeConfigurationProviderPlugin extends AbstractPlugin implements OauthRequestGrantTypeConfigurationProviderPluginInterface
{
    /**
     * @uses \Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\ApplicationIdentifierRequestBuilderPlugin::GLUE_BACKEND_API_APPLICATION
     *
     * @var string
     */
    protected const GLUE_BACKEND_API_APPLICATION = 'GLUE_BACKEND_API_APPLICATION';

    /**
     * {@inheritDoc}
     *  - Checks whether the requested oauth grant type equals to {@link \Spryker\Zed\Oauth\OauthConfig::GRANT_TYPE_PASSWORD}.
     *  - Checks whether the requested application context equals to GlueBackendApiApplication.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OauthRequestTransfer $oauthRequestTransfer
     * @param \Generated\Shared\Transfer\GlueAuthenticationRequestContextTransfer $glueAuthenticationRequestContextTransfer
     *
     * @return bool
     */
    public function isApplicable(
        OauthRequestTransfer $oauthRequestTransfer,
        GlueAuthenticationRequestContextTransfer $glueAuthenticationRequestContextTransfer
    ): bool {
        return (
            $oauthRequestTransfer->getGrantType() === OauthConfig::GRANT_TYPE_PASSWORD &&
            $glueAuthenticationRequestContextTransfer->getRequestApplication() === static::GLUE_BACKEND_API_APPLICATION
        );
    }

    /**
     * {@inheritDoc}
     *  - Returns configuration of password GrantType.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer
     */
    public function getGrantTypeConfiguration(): OauthGrantTypeConfigurationTransfer
    {
        return (new OauthGrantTypeConfigurationTransfer())
            ->setIdentifier(OauthConfig::GRANT_TYPE_PASSWORD)
            ->setBuilderFullyQualifiedClassName(UserPasswordGrantTypeBuilder::class);
    }
}
