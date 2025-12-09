<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileCreateParams;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceParams;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\ProfilesRawContract;

final class ProfilesRawService implements ProfilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param array{profile: array<string,mixed>}|ProfileCreateParams $params
     *
     * @return BaseResponse<ProfileNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        array|ProfileCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['profiles/%1$s', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ProfileNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns the specified user profile.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     *
     * @return BaseResponse<ProfileGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['profiles/%1$s', $userID],
            options: $requestOptions,
            convert: ProfileGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update a profile
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array{
     *   patch: list<array{op: string, path: string, value: string}>
     * }|ProfileUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        array|ProfileUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['profiles/%1$s', $userID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Deletes the specified user profile.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['profiles/%1$s', $userID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * When using `PUT`, be sure to include all the key-value pairs required by the recipient's profile.
     * Any key-value pairs that exist in the profile but fail to be included in the `PUT` request will be
     * removed from the profile. Remember, a `PUT` update is a full replacement of the data. For partial updates,
     * use the [Patch](https://www.courier.com/docs/reference/profiles/patch/) request.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array{profile: array<string,mixed>}|ProfileReplaceParams $params
     *
     * @return BaseResponse<ProfileReplaceResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        array|ProfileReplaceParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['profiles/%1$s', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ProfileReplaceResponse::class,
        );
    }
}
