<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AuthContract
{
    /**
     * @api
     *
     * @param array<mixed>|AuthIssueTokenParams $params
     *
     * @throws APIException
     */
    public function issueToken(
        array|AuthIssueTokenParams $params,
        ?RequestOptions $requestOptions = null
    ): AuthIssueTokenResponse;
}
