<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Persistence;

use Generated\Shared\Transfer\OauthClientTransfer;
use Generated\Shared\Transfer\SpyOauthAccessTokenEntityTransfer;
use Generated\Shared\Transfer\SpyOauthClientEntityTransfer;
use Generated\Shared\Transfer\SpyOauthScopeEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Spryker\Zed\Oauth\Persistence\OauthPersistenceFactory getFactory()
 */
class OauthEntityManager extends AbstractEntityManager implements OauthEntityManagerInterface
{
    /**
     * @var string
     */
    protected const COLUMN_REVOKED_AT = 'RevokedAt';

    public function saveAccessToken(SpyOauthAccessTokenEntityTransfer $spyOauthAccessTokenEntityTransfer): SpyOauthAccessTokenEntityTransfer
    {
        /** @var \Generated\Shared\Transfer\SpyOauthAccessTokenEntityTransfer $spyOauthAccessTokenEntityTransfer */
        $spyOauthAccessTokenEntityTransfer = $this->save($spyOauthAccessTokenEntityTransfer);

        return $spyOauthAccessTokenEntityTransfer;
    }

    public function saveClient(SpyOauthClientEntityTransfer $spyOauthClientEntityTransfer): SpyOauthClientEntityTransfer
    {
        /** @var \Generated\Shared\Transfer\SpyOauthClientEntityTransfer $spyOauthClientEntityTransfer */
        $spyOauthClientEntityTransfer = $this->save($spyOauthClientEntityTransfer);

        return $spyOauthClientEntityTransfer;
    }

    public function updateClient(OauthClientTransfer $oauthClientTransfer): OauthClientTransfer
    {
        $oauthClient = $this->getFactory()->createSpyOauthClient();
        $oauthClient->fromArray($oauthClientTransfer->toArray());
        $oauthClient->setNew(false);
        $oauthClient->save();

        return $oauthClientTransfer;
    }

    public function saveScope(SpyOauthScopeEntityTransfer $spyOauthScopeEntityTransfer): SpyOauthScopeEntityTransfer
    {
        /** @var \Generated\Shared\Transfer\SpyOauthScopeEntityTransfer $spyOauthScopeEntityTransfer */
        $spyOauthScopeEntityTransfer = $this->save($spyOauthScopeEntityTransfer);

        return $spyOauthScopeEntityTransfer;
    }

    public function deleteAccessTokenByIdentifier(string $identifier): void
    {
        /** @var \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken|null $oauthAccessTokenEntity */
        $oauthAccessTokenEntity = $this->getFactory()
            ->createAccessTokenQuery()
            ->findOneByIdentifier($identifier);

        if ($oauthAccessTokenEntity) {
            $oauthAccessTokenEntity->delete();
        }
    }
}
