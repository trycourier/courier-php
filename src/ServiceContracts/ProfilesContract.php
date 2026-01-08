<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams\Patch;
use Courier\RequestOptions;

/**
 * @phpstan-import-type PatchShape from \Courier\Profiles\ProfileUpdateParams\Patch
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ProfilesContract
{
    /**
     * @api
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
    ): ProfileNewResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): ProfileGetResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): ProfileReplaceResponse;
}
