<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuditEventsRawContract;

final class AuditEventsRawService implements AuditEventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch a specific audit event by ID.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['audit-events/%1$s', $auditEventID],
            options: $requestOptions,
            convert: AuditEvent::class,
        );
    }

    /**
     * @api
     *
     * Fetch the list of audit events
     *
     * @param array{cursor?: string|null}|AuditEventListParams $params
     *
     * @return BaseResponse<AuditEventListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AuditEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = AuditEventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'audit-events',
            query: $parsed,
            options: $options,
            convert: AuditEventListResponse::class,
        );
    }
}
