<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuditEventsContract;

final class AuditEventsService implements AuditEventsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch a specific audit event by ID.
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        ?RequestOptions $requestOptions = null
    ): AuditEvent {
        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function list(
        array|AuditEventListParams $params,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse {
        [$parsed, $options] = AuditEventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'audit-events',
            query: $parsed,
            options: $options,
            convert: AuditEventListResponse::class,
        );
    }
}
