<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface AuditEventsContract
{
    /**
     * @api
     *
     * @return AuditEvent<HasRawResponse>
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
     * @return AuditEvent<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $auditEventID,
        mixed $params,
        ?RequestOptions $requestOptions = null,
    ): AuditEvent;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of audit events
     *
     * @return AuditEventListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AuditEventListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse;
}
