<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Oauth\Business\Model\League\Grant;

use DateInterval;
use Generated\Shared\Transfer\OauthErrorTransfer;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseInterface;
use Spryker\Zed\Oauth\OauthConfig;

class GrantTypeExecutor implements GrantTypeExecutorInterface
{
    /**
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $authorizationServer;

    /**
     * @var \Spryker\Zed\Oauth\OauthConfig
     */
    protected $oauthConfig;

    public function __construct(
        AuthorizationServer $authorizationServer,
        OauthConfig $oauthConfig
    ) {
        $this->authorizationServer = $authorizationServer;
        $this->oauthConfig = $oauthConfig;
    }

    public function processAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer, GrantTypeInterface $grant): OauthResponseTransfer
    {
        try {
            $accessTokenRequest = $this->createAccessTokenRequest($oauthRequestTransfer);

            $this->authorizationServer->enableGrantType(
                $grant,
                new DateInterval($this->oauthConfig->getAccessTokenTTL()),
            );

            $response = $this->authorizationServer->respondToAccessTokenRequest($accessTokenRequest, new Response());

            return $this->createOauthResponseTransfer($response);
        } catch (OAuthServerException $exception) {
            return $this->createErrorOauthResponseTransfer($exception);
        }
    }

    protected function createErrorOauthResponseTransfer(OAuthServerException $exception): OauthResponseTransfer
    {
        $oauthErrorTransfer = new OauthErrorTransfer();
        $oauthErrorTransfer
            ->setErrorType($exception->getErrorType())
            ->setMessage($exception->getMessage());

        return (new OauthResponseTransfer())
            ->setIsValid(false)
            ->setError($oauthErrorTransfer);
    }

    protected function createAccessTokenRequest(OauthRequestTransfer $oauthRequestTransfer): ServerRequest
    {
        $accessTokenRequest = new ServerRequest('POST', '');
        $oauthRequestArray = $oauthRequestTransfer->toArray();
        if (
            $oauthRequestTransfer->getGlueAuthenticationRequestContext() &&
            $oauthRequestTransfer->getGlueAuthenticationRequestContext()->getRequestApplication()
        ) {
            $oauthRequestArray = array_merge(
                ['request_application' => $oauthRequestTransfer->getGlueAuthenticationRequestContext()->getRequestApplication()],
                $oauthRequestArray,
            );
        }

        return $accessTokenRequest->withParsedBody($oauthRequestArray);
    }

    protected function createOauthResponseTransfer(ResponseInterface $response): OauthResponseTransfer
    {
        $data = json_decode((string)$response->getBody(), true);

        return (new OauthResponseTransfer())
            ->fromArray($data, true)
            ->setIsValid(true);
    }
}
