<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AuditEventsRawContract
{
    /**
     * @api
     *
     * @param string $auditEventID A unique identifier associated with the audit event you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuditEvent>
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AuditEventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuditEventListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AuditEventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
