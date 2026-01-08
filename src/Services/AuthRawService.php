<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuthRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class AuthRawService implements AuthRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns a new access token.
     *
     * @param array{expiresIn: string, scope: string}|AuthIssueTokenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthIssueTokenResponse>
     *
     * @throws APIException
     */
    public function issueToken(
        array|AuthIssueTokenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthIssueTokenParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'auth/issue-token',
            body: (object) $parsed,
            options: $options,
            convert: AuthIssueTokenResponse::class,
        );
    }
}
