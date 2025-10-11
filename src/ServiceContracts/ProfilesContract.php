<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams\Patch;
use Courier\RequestOptions;

interface ProfilesContract
{
    /**
     * @api
     *
     * @param array<string, mixed> $profile
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileNewResponse;

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
    ): ProfileNewResponse;

    /**
     * @api
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
     * @param list<Patch> $patch list of patch operations to apply to the profile
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        $patch,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;

    /**
     * @api
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
     * @param array<string, mixed> $profile
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        $profile,
        ?RequestOptions $requestOptions = null
    ): ProfileReplaceResponse;

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
    ): ProfileReplaceResponse;
}
