<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Communication\Plugin\Oauth;

use Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oauth\Business\Model\League\Grant\RefreshTokenGrantType;
use Spryker\Zed\Oauth\OauthConfig;
use Spryker\Zed\OauthExtension\Dependency\Plugin\OauthGrantTypeConfigurationProviderPluginInterface;

/**
 * @method \Spryker\Zed\Oauth\OauthConfig getConfig()
 * @method \Spryker\Zed\Oauth\Business\OauthFacadeInterface getFacade()
 */
class RefreshTokenOauthGrantTypeConfigurationProviderPlugin extends AbstractPlugin implements OauthGrantTypeConfigurationProviderPluginInterface
{
    /**
     * {@inheritDoc}
     *  - Returns configuration of RefreshToken GrantType.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer
     */
    public function getGrantTypeConfiguration(): OauthGrantTypeConfigurationTransfer
    {
        return (new OauthGrantTypeConfigurationTransfer())
            ->setIdentifier(OauthConfig::GRANT_TYPE_REFRESH_TOKEN)
            ->setFullyQualifiedClassName(RefreshTokenGrantType::class);
    }
}
