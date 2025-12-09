<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
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
     * @param array{expires_in: string, scope: string}|AuthIssueTokenParams $params
     *
     * @throws APIException
     */
    public function issueToken(
        array|AuthIssueTokenParams $params,
        ?RequestOptions $requestOptions = null
    ): AuthIssueTokenResponse {
        [$parsed, $options] = AuthIssueTokenParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AuthIssueTokenResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'auth/issue-token',
            body: (object) $parsed,
            options: $options,
            convert: AuthIssueTokenResponse::class,
        );

        return $response->parse();
    }
}
