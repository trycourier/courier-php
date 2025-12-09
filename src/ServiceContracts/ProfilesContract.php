<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\RequestOptions;

interface ProfilesContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     * @param array<string,mixed> $profile
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        array $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileNewResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested profile
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): ProfileGetResponse;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param list<array{
     *   op: string, path: string, value: string
     * }> $patch List of patch operations to apply to the profile
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        array $patch,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     *
     * @throws APIException
     */
    public function delete(
        string $userID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $userID a unique identifier representing the user associated with the requested user profile
     * @param array<string,mixed> $profile
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        array $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileReplaceResponse;
}
