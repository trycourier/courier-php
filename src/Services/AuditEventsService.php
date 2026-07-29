<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AuditEvents\AuditEvent;
use Courier\AuditEvents\AuditEventListResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuditEventsContract;

/**
 * Read the audit trail of configuration and access changes in your workspace.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
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
     * Returns one audit event by id, including the actor who performed it, the target they changed, the source, the event type, and a timestamp.
     *
     * @param string $auditEventID A unique identifier associated with the audit event you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $auditEventID,
        RequestOptions|array|null $requestOptions = null
    ): AuditEvent {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($auditEventID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the workspace's audit event log with cursor paging. Each event records the actor, target, source, type, and timestamp of a change.
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of audit events
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): AuditEventListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
