<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Oauth;

use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Service\Oauth\Dependency\Service\OauthToUtilEncodingServiceInterface;
use Spryker\Service\Oauth\Jwt\JwtTokenParser;
use Spryker\Service\Oauth\Jwt\JwtTokenParserInterface;
use Spryker\Service\Oauth\Jwt\TokenDataExtractor;
use Spryker\Service\Oauth\Jwt\TokenDataExtractorInterface;

class OauthServiceFactory extends AbstractServiceFactory
{
    public function createTokenDataExtractor(): TokenDataExtractorInterface
    {
        return new TokenDataExtractor(
            $this->createJwtTokenParser(),
        );
    }

    public function createJwtTokenParser(): JwtTokenParserInterface
    {
        return new JwtTokenParser(
            $this->getUtilEncodingService(),
        );
    }

    public function getUtilEncodingService(): OauthToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(OauthDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
