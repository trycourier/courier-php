<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\BaseCheck;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;

interface ChecksContract
{
    /**
     * @api
     *
     * @param string $id
     * @param list<BaseCheck> $checks
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        $id,
        $checks,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse;

    /**
     * @api
     *
     * @param string $id
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        $id,
        ?RequestOptions $requestOptions = null
    ): CheckListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): CheckListResponse;

    /**
     * @api
     *
     * @param string $id
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
