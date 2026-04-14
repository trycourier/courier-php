<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type BaseCheckShape from \Courier\Notifications\BaseCheck
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ChecksContract
{
    /**
     * @api
     *
     * @param string $submissionID path param: Submission ID
     * @param string $id path param: Notification template ID
     * @param list<BaseCheck|BaseCheckShape> $checks Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        string $id,
        array $checks,
        RequestOptions|array|null $requestOptions = null,
    ): CheckUpdateResponse;

    /**
     * @api
     *
     * @param string $submissionID submission ID
     * @param string $id notification template ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): CheckListResponse;

    /**
     * @api
     *
     * @param string $submissionID submission ID
     * @param string $id notification template ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
