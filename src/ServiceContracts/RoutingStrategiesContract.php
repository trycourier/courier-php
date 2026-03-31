<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Channel;
use Courier\Core\Exceptions\APIException;
use Courier\MessageProvidersType;
use Courier\MessageRouting;
use Courier\RequestOptions;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListResponse;
use Courier\RoutingStrategies\RoutingStrategyMutationResponse;

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
     * @param string $name human-readable name for the routing strategy
     * @param MessageRouting|MessageRoutingShape $routing routing tree defining channel selection method and order
     * @param array<string,Channel|ChannelShape>|null $channels Per-channel delivery configuration. Defaults to empty if omitted.
     * @param string|null $description optional description of the routing strategy
     * @param array<string,MessageProvidersType|MessageProvidersTypeShape>|null $providers Per-provider delivery configuration. Defaults to empty if omitted.
     * @param list<string>|null $tags optional tags for categorization
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
        RequestOptions|array|null $requestOptions = null,
    ): RoutingStrategyMutationResponse;

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
    ): RoutingStrategyMutationResponse;
}
