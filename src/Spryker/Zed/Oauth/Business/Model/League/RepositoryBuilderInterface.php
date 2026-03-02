<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model\League;

use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\RefreshTokenRepositoryInterface;

interface RepositoryBuilderInterface
{
    public function createClientRepository(): ClientRepositoryInterface;

    public function createScopeRepository(): ScopeRepositoryInterface;

    public function createAccessTokenRepository(): AccessTokenRepositoryInterface;

    public function createUserRepository(): UserRepositoryInterface;

    public function createOauthUserRepository(): UserRepositoryInterface;

    public function createRefreshTokenRepository(): RefreshTokenRepositoryInterface;
}
