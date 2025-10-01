<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListParams;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuditEventsContract;

use const Courier\Core\OMIT as omit;

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
     * @return AuditEvent<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        ?RequestOptions $requestOptions = null
    ): AuditEvent {
        $params = [];

        return $this->retrieveRaw($auditEventID, $params, $requestOptions);
    }

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
     * @param string|null $cursor a unique identifier that allows for fetching the next set of audit events
     *
     * @return AuditEventListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse {
        $params = ['cursor' => $cursor];

        return $this->listRaw($params, $requestOptions);
    }

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
    ): AuditEventListResponse {
        [$parsed, $options] = AuditEventListParams::parseRequest(
            $params,
            $requestOptions
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
