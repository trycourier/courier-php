<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuthContract;

final class AuthService implements AuthContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a new access token.
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
    ): AuthIssueTokenResponse {
        $params = ['expiresIn' => $expiresIn, 'scope' => $scope];

        return $this->issueTokenRaw($params, $requestOptions);
    }

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
    ): AuthIssueTokenResponse {
        [$parsed, $options] = AuthIssueTokenParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'auth/issue-token',
            body: (object) $parsed,
            options: $options,
            convert: AuthIssueTokenResponse::class,
        );
    }
}
