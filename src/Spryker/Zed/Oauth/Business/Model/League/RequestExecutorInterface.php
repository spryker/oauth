<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model\League;

use Generated\Shared\Transfer\OauthGrantTypeConfigurationTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;

interface RequestExecutorInterface
{
    public function createOauthGrantTypeConfigurationTransfer(OauthRequestTransfer $oauthRequestTransfer): ?OauthGrantTypeConfigurationTransfer;

    public function createUnsupportedGrantTypeError(OauthRequestTransfer $oauthRequestTransfer): OauthResponseTransfer;

    public function expandOauthRequestTransfer(OauthRequestTransfer $oauthRequestTransfer): OauthRequestTransfer;
}
