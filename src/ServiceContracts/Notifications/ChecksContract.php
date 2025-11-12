<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\Checks\CheckDeleteParams;
use Courier\Notifications\Checks\CheckListParams;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateParams;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;

interface ChecksContract
{
    /**
     * @api
     *
     * @param array<mixed>|CheckUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        array|CheckUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse;

    /**
     * @api
     *
     * @param array<mixed>|CheckListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        array|CheckListParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckListResponse;

    /**
     * @api
     *
     * @param array<mixed>|CheckDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        array|CheckDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
