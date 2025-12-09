<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AuditEventsRawContract
{
    /**
     * @api
     *
     * @param string $auditEventID A unique identifier associated with the audit event you wish to retrieve
     *
     * @return BaseResponse<AuditEvent>
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|AuditEventListParams $params
     *
     * @return BaseResponse<AuditEventListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AuditEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
