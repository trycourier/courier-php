<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Profiles\ProfileCreateParams;
use Courier\Profiles\ProfileGetResponse;
use Courier\Profiles\ProfileNewResponse;
use Courier\Profiles\ProfileReplaceParams;
use Courier\Profiles\ProfileReplaceResponse;
use Courier\Profiles\ProfileUpdateParams;
use Courier\RequestOptions;

interface ProfilesContract
{
    /**
     * @api
     *
     * @param array<mixed>|ProfileCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        string $userID,
        array|ProfileCreateParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @param array<mixed>|ProfileUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $userID,
        array|ProfileUpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @param array<mixed>|ProfileReplaceParams $params
     *
     * @throws APIException
     */
    public function replace(
        string $userID,
        array|ProfileReplaceParams $params,
        ?RequestOptions $requestOptions = null,
    ): ProfileReplaceResponse;
}
