<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;

interface ChecksContract
{
    /**
     * @api
     *
     * @param string $submissionID Path param:
     * @param string $id Path param:
     * @param list<array{
     *   id: string, status: 'RESOLVED'|'FAILED'|'PENDING'|Status, type: 'custom'|Type
     * }|BaseCheck> $checks Body param:
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        string $id,
        array $checks,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        string $id,
        ?RequestOptions $requestOptions = null
    ): CheckListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
