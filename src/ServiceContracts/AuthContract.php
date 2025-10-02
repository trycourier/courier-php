<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Auth\AuthIssueTokenResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;

interface AuthContract
{
    /**
     * @api
     *
     * @param string $expiresIn
     * @param string $scope
     *
     * @return AuthIssueTokenResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function issueToken(
        $expiresIn,
        $scope,
        ?RequestOptions $requestOptions = null
    ): AuthIssueTokenResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AuthIssueTokenResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function issueTokenRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AuthIssueTokenResponse;
}
