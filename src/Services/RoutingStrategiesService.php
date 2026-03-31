<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Channel;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\MessageProvidersType;
use Courier\MessageRouting;
use Courier\RequestOptions;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListResponse;
use Courier\RoutingStrategies\RoutingStrategyMutationResponse;
use Courier\ServiceContracts\RoutingStrategiesContract;

/**
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RoutingStrategiesService implements RoutingStrategiesContract
{
    /**
     * @api
     */
    public RoutingStrategiesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RoutingStrategiesRawService($client);
    }

    /**
     * @api
     *
     * Create a routing strategy. Requires a name and routing configuration at minimum. Channels and providers default to empty if omitted.
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
    ): RoutingStrategyMutationResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'routing' => $routing,
                'channels' => $channels,
                'description' => $description,
                'providers' => $providers,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a routing strategy by ID. Returns the full entity including routing content and metadata.
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): RoutingStrategyGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List routing strategies in your workspace. Returns metadata only (no routing/channels/providers content). Use GET /routing-strategies/{id} for full details.
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
    ): RoutingStrategyListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a routing strategy. The strategy must not have associated notification templates. Unlink all templates before archiving.
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a routing strategy. Full document replacement; the caller must send the complete desired state. Missing optional fields are cleared.
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
    ): RoutingStrategyMutationResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'routing' => $routing,
                'channels' => $channels,
                'description' => $description,
                'providers' => $providers,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
