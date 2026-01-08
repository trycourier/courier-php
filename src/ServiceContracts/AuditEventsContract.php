<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AuditEventsContract
{
    /**
     * @api
     *
     * @param string $auditEventID A unique identifier associated with the audit event you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        RequestOptions|array|null $requestOptions = null
    ): AuditEvent;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of audit events
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): AuditEventListResponse;
}
