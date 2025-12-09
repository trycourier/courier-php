<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuditEventsContract;

final class AuditEventsService implements AuditEventsContract
{
    /**
     * @api
     */
    public AuditEventsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AuditEventsRawService($client);
    }

    /**
     * @api
     *
     * Fetch a specific audit event by ID.
     *
     * @param string $auditEventID A unique identifier associated with the audit event you wish to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        ?RequestOptions $requestOptions = null
    ): AuditEvent {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($auditEventID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch the list of audit events
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of audit events
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null
    ): AuditEventListResponse {
        $params = ['cursor' => $cursor];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
