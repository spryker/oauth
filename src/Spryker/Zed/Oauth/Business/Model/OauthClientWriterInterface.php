<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model;

use Generated\Shared\Transfer\OauthClientTransfer;

interface OauthClientWriterInterface
{
    public function save(OauthClientTransfer $oauthClientTransfer): OauthClientTransfer;
}
