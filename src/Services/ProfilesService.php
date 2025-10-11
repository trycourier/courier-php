<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileCreateParams;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceParams;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams;
use Courier\Profiles\ProfileUpdateParams\Patch;
use Courier\RequestOptions;
use Courier\ServiceContracts\ProfilesContract;
use Courier\Services\Profiles\ListsService;

final class ProfilesService implements ProfilesContract
{
    /**
     * @@api
     */
    public ListsService $lists;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->lists = new ListsService($client);
    }

    /**
     * @api
     *
     * Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.
     *
     * @param array<string, mixed> $profile
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileNewResponse {
        $params = ['profile' => $profile];

        return $this->createRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ProfileNewResponse {
        [$parsed, $options] = ProfileCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ProfileGetResponse {
        // @phpstan-ignore-next-line;
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
     * @param list<Patch> $patch list of patch operations to apply to the profile
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        $patch,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['patch' => $patch];

        return $this->updateRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = ProfileUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
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
     * @param array<string, mixed> $profile
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileReplaceResponse {
        $params = ['profile' => $profile];

        return $this->replaceRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function replaceRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ProfileReplaceResponse {
        [$parsed, $options] = ProfileReplaceParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['profiles/%1$s', $userID],
            body: (object) $parsed,
            options: $options,
            convert: ProfileReplaceResponse::class,
        );
    }
}
