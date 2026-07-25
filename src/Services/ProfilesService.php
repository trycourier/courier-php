<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams\Patch;
use Courier\RequestOptions;
use Courier\ServiceContracts\ProfilesContract;
use Courier\Services\Profiles\ListsService;

/**
 * @phpstan-import-type PatchShape from \Courier\Profiles\ProfileUpdateParams\Patch
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ProfilesService implements ProfilesContract
{
    /**
     * @api
     */
    public ProfilesRawService $raw;

    /**
     * @api
     */
    public ListsService $lists;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProfilesRawService($client);
        $this->lists = new ListsService($client);
    }

    /**
     * @api
     *
     * Merges the supplied values into a user's profile, creating it if absent and leaving any key you omit untouched. Prefer this for everyday writes.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param array<string,mixed> $profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        array $profile,
        RequestOptions|array|null $requestOptions = null,
    ): ProfileNewResponse {
        $params = Util::removeNulls(['profile' => $profile]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a user's stored profile and preferences, including the email address, phone number, and push tokens Courier can reach them on.
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ProfileGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Applies a JSON Patch to a user profile, adding, removing, or replacing individual fields without sending the whole object.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param list<Patch|PatchShape> $patch list of patch operations to apply to the profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        array $patch,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['patch' => $patch]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes a user's profile and stored contact details. List subscriptions and preferences are separate resources, so remove those too if required.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($userID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Overwrites a user profile in full, removing any key absent from the request body. Use the patch endpoint when changing a single field.
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array<string,mixed> $profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        array $profile,
        RequestOptions|array|null $requestOptions = null,
    ): ProfileReplaceResponse {
        $params = Util::removeNulls(['profile' => $profile]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
