<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Persistence;

use Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery;
use Orm\Zed\Oauth\Persistence\SpyOauthClient;
use Orm\Zed\Oauth\Persistence\SpyOauthClientQuery;
use Orm\Zed\Oauth\Persistence\SpyOauthScopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\Oauth\Persistence\Propel\Mapper\OauthTokenMapper;

/**
 * @method \Spryker\Zed\Oauth\OauthConfig getConfig()
 * @method \Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface getRepository()
 */
class OauthPersistenceFactory extends AbstractPersistenceFactory
{
    public function createOauthClientQuery(): SpyOauthClientQuery
    {
        return SpyOauthClientQuery::create();
    }

    public function createAccessTokenQuery(): SpyOauthAccessTokenQuery
    {
        return SpyOauthAccessTokenQuery::create();
    }

    public function createScopeQuery(): SpyOauthScopeQuery
    {
        return SpyOauthScopeQuery::create();
    }

    public function createOauthTokenMapper(): OauthTokenMapper
    {
        return new OauthTokenMapper();
    }

    public function createSpyOauthClient(): SpyOauthClient
    {
        return new SpyOauthClient();
    }
}
