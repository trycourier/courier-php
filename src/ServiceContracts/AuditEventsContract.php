<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AuditEventsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        ?RequestOptions $requestOptions = null
    ): AuditEvent;

    /**
     * @api
     *
     * @param array<mixed>|AuditEventListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|AuditEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse;
}
