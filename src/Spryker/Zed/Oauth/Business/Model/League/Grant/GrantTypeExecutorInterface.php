<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model\League\Grant;

use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;

interface GrantTypeExecutorInterface
{
    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer, GrantTypeInterface $grant): OauthResponseTransfer;
}
