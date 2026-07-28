<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Channel;
use Courier\Core\Exceptions\APIException;
use Courier\MessageProvidersType;
use Courier\MessageRouting;
use Courier\RequestOptions;
use Courier\RoutingStrategies\AssociatedNotificationListResponse;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListResponse;

/**
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RoutingStrategiesContract
{
    /**
     * @api
     *
     * @param string $name body param: Human-readable name for the routing strategy
     * @param MessageRouting|MessageRoutingShape $routing body param: Routing tree defining channel selection method and order
     * @param array<string,Channel|ChannelShape>|null $channels Body param: Per-channel delivery configuration. Defaults to empty if omitted.
     * @param string|null $description body param: Optional description of the routing strategy
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape>|null $providers Body param: Per-provider delivery configuration. Defaults to empty if omitted.
     * @param list<string>|null $tags body param: Optional tags for categorization
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        MessageRouting|array $routing,
        ?array $channels = null,
        ?string $description = null,
        ?array $providers = null,
        ?array $tags = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoutingStrategyGetResponse;

    /**
     * @api
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RoutingStrategyGetResponse;

    /**
     * @api
     *
     * @param string|null $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param int $limit Maximum number of results per page. Default 20, max 100.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        int $limit = 20,
        RequestOptions|array|null $requestOptions = null,
    ): RoutingStrategyListResponse;

    /**
     * @api
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id routing strategy ID (`rs_` prefix)
     * @param string|null $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param int $limit Maximum number of results per page. Default 20, max 100.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listNotifications(
        string $id,
        ?string $cursor = null,
        int $limit = 20,
        RequestOptions|array|null $requestOptions = null,
    ): AssociatedNotificationListResponse;

    /**
     * @api
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param string $name human-readable name for the routing strategy
     * @param MessageRouting|MessageRoutingShape $routing routing tree defining channel selection method and order
     * @param array<string,Channel|ChannelShape>|null $channels Per-channel delivery configuration. Omit to clear.
     * @param string|null $description Optional description. Omit or null to clear.
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape>|null $providers Per-provider delivery configuration. Omit to clear.
     * @param list<string>|null $tags Optional tags. Omit or null to clear.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        string $name,
        MessageRouting|array $routing,
        ?array $channels = null,
        ?string $description = null,
        ?array $providers = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoutingStrategyGetResponse;
}
