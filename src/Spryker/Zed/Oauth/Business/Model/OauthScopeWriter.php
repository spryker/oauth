<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model;

use Generated\Shared\Transfer\OauthScopeTransfer;
use Generated\Shared\Transfer\SpyOauthScopeEntityTransfer;
use Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface;

class OauthScopeWriter implements OauthScopeWriterInterface
{
    /**
     * @var \Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface
     */
    protected $oauthEntityManager;

    public function __construct(OauthEntityManagerInterface $oauthEntityManager)
    {
        $this->oauthEntityManager = $oauthEntityManager;
    }

    public function save(OauthScopeTransfer $oauthScopeTransfer): OauthScopeTransfer
    {
        $oauthEntityTransfer = new SpyOauthScopeEntityTransfer();
        $oauthEntityTransfer->fromArray($oauthScopeTransfer->toArray());

        $oauthEntityTransfer = $this->oauthEntityManager->saveScope($oauthEntityTransfer);

        $oauthScopeTransfer->fromArray($oauthEntityTransfer->toArray(), true);

        return $oauthScopeTransfer;
    }
}
