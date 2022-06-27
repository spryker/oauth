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
use Spryker\Zed\Oauth\Business\Mapper\OauthRefreshTokenMapperInterface;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\AccessTokenRepository;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\ClientRepository;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\RefreshTokenRepository;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\RefreshTokenRepositoryInterface;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\ScopeRepository;
use Spryker\Zed\Oauth\Business\Model\League\Repositories\UserRepository;
use Spryker\Zed\Oauth\Dependency\Service\OauthToUtilEncodingServiceInterface;
use Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface;
use Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface;

class RepositoryBuilder implements RepositoryBuilderInterface
{
    /**
     * @var \Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface
     */
    protected $oauthRepository;

    /**
     * @var \Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface
     */
    protected $oauthEntityManager;

    /**
     * @var \Spryker\Zed\Oauth\Dependency\Service\OauthToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \Spryker\Zed\Oauth\Business\Mapper\OauthRefreshTokenMapperInterface
     */
    protected $oauthRefreshTokenMapper;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserProviderPluginInterface>
     */
    protected $userProviderPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserProviderPluginInterface>
     */
    protected $oauthUserProviderPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthScopeProviderPluginInterface>
     */
    protected $scopeProviderPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserIdentifierFilterPluginInterface>
     */
    protected $oauthUserIdentifierFilterPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenRevokerPluginInterface>
     */
    protected $oauthRefreshTokenRevokePlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokensRevokerPluginInterface>
     */
    protected $oauthRefreshTokensRevokePlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenCheckerPluginInterface>
     */
    protected $oauthRefreshTokenCheckerPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenSaverPluginInterface>
     */
    protected $oauthRefreshTokenSaverPlugins;

    /**
     * @var array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenPersistencePluginInterface>
     */
    protected $oauthRefreshTokenPersistencePlugins;

    /**
     * @var array<\Spryker\Glue\OauthExtension\Dependency\Plugin\ScopeFinderPluginInterface>
     */
    protected $scopeFinderPlugins;

    /**
     * @param \Spryker\Zed\Oauth\Persistence\OauthRepositoryInterface $oauthRepository
     * @param \Spryker\Zed\Oauth\Persistence\OauthEntityManagerInterface $oauthEntityManager
     * @param \Spryker\Zed\Oauth\Dependency\Service\OauthToUtilEncodingServiceInterface $utilEncodingService
     * @param \Spryker\Zed\Oauth\Business\Mapper\OauthRefreshTokenMapperInterface $oauthRefreshTokenMapper
     * @param array $userProviderPlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthScopeProviderPluginInterface> $scopeProviderPlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserIdentifierFilterPluginInterface> $oauthUserIdentifierFilterPlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenRevokerPluginInterface> $oauthRefreshTokenRevokePlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokensRevokerPluginInterface> $oauthRefreshTokensRevokePlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenCheckerPluginInterface> $oauthRefreshTokenCheckerPlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenSaverPluginInterface> $oauthRefreshTokenSaverPlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenPersistencePluginInterface> $oauthRefreshTokenPersistencePlugins
     * @param array<\Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserProviderPluginInterface> $oauthUserProviderPlugins
     * @param array<\Spryker\Glue\OauthExtension\Dependency\Plugin\ScopeFinderPluginInterface> $scopeFinderPlugins
     */
    public function __construct(
        OauthRepositoryInterface $oauthRepository,
        OauthEntityManagerInterface $oauthEntityManager,
        OauthToUtilEncodingServiceInterface $utilEncodingService,
        OauthRefreshTokenMapperInterface $oauthRefreshTokenMapper,
        array $userProviderPlugins = [],
        array $scopeProviderPlugins = [],
        array $oauthUserIdentifierFilterPlugins = [],
        array $oauthRefreshTokenRevokePlugins = [],
        array $oauthRefreshTokensRevokePlugins = [],
        array $oauthRefreshTokenCheckerPlugins = [],
        array $oauthRefreshTokenSaverPlugins = [],
        array $oauthRefreshTokenPersistencePlugins = [],
        array $oauthUserProviderPlugins = [],
        array $scopeFinderPlugins = []
    ) {
        $this->oauthRepository = $oauthRepository;
        $this->oauthEntityManager = $oauthEntityManager;
        $this->utilEncodingService = $utilEncodingService;
        $this->oauthRefreshTokenMapper = $oauthRefreshTokenMapper;
        $this->userProviderPlugins = $userProviderPlugins;
        $this->scopeProviderPlugins = $scopeProviderPlugins;
        $this->oauthUserIdentifierFilterPlugins = $oauthUserIdentifierFilterPlugins;
        $this->oauthRefreshTokenRevokePlugins = $oauthRefreshTokenRevokePlugins;
        $this->oauthRefreshTokensRevokePlugins = $oauthRefreshTokensRevokePlugins;
        $this->oauthRefreshTokenCheckerPlugins = $oauthRefreshTokenCheckerPlugins;
        $this->oauthRefreshTokenSaverPlugins = $oauthRefreshTokenSaverPlugins;
        $this->oauthRefreshTokenPersistencePlugins = $oauthRefreshTokenPersistencePlugins;
        $this->oauthUserProviderPlugins = $oauthUserProviderPlugins;
        $this->scopeFinderPlugins = $scopeFinderPlugins;
    }

    /**
     * @return \League\OAuth2\Server\Repositories\ClientRepositoryInterface
     */
    public function createClientRepository(): ClientRepositoryInterface
    {
        return new ClientRepository($this->oauthRepository);
    }

    /**
     * @return \League\OAuth2\Server\Repositories\ScopeRepositoryInterface
     */
    public function createScopeRepository(): ScopeRepositoryInterface
    {
        return new ScopeRepository(
            $this->oauthRepository,
            $this->scopeProviderPlugins,
            $this->scopeFinderPlugins,
        );
    }

    /**
     * @return \League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface
     */
    public function createAccessTokenRepository(): AccessTokenRepositoryInterface
    {
        return new AccessTokenRepository(
            $this->oauthRepository,
            $this->oauthEntityManager,
            $this->utilEncodingService,
            $this->oauthUserIdentifierFilterPlugins,
        );
    }

    /**
     * @return \League\OAuth2\Server\Repositories\UserRepositoryInterface
     */
    public function createUserRepository(): UserRepositoryInterface
    {
        return new UserRepository($this->userProviderPlugins);
    }

    /**
     * @return \League\OAuth2\Server\Repositories\UserRepositoryInterface
     */
    public function createOauthUserRepository(): UserRepositoryInterface
    {
        return new UserRepository($this->oauthUserProviderPlugins);
    }

    /**
     * @return \Spryker\Zed\Oauth\Business\Model\League\Repositories\RefreshTokenRepositoryInterface
     */
    public function createRefreshTokenRepository(): RefreshTokenRepositoryInterface
    {
        return new RefreshTokenRepository(
            $this->oauthRefreshTokenMapper,
            $this->oauthRefreshTokenRevokePlugins,
            $this->oauthRefreshTokensRevokePlugins,
            $this->oauthRefreshTokenCheckerPlugins,
            $this->oauthRefreshTokenSaverPlugins,
            $this->oauthRefreshTokenPersistencePlugins,
        );
    }
}
