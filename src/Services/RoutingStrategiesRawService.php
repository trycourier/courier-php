<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Channel;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\MessageProvidersType;
use Courier\MessageRouting;
use Courier\RequestOptions;
use Courier\RoutingStrategies\AssociatedNotificationListResponse;
use Courier\RoutingStrategies\RoutingStrategyCreateParams;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListNotificationsParams;
use Courier\RoutingStrategies\RoutingStrategyListParams;
use Courier\RoutingStrategies\RoutingStrategyListResponse;
use Courier\RoutingStrategies\RoutingStrategyMutationResponse;
use Courier\RoutingStrategies\RoutingStrategyReplaceParams;
use Courier\ServiceContracts\RoutingStrategiesRawContract;

/**
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 * @phpstan-import-type ChannelShape from \Courier\Channel
 * @phpstan-import-type MessageProvidersTypeShape from \Courier\MessageProvidersType
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RoutingStrategiesRawService implements RoutingStrategiesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a routing strategy. Requires a name and routing configuration at minimum. Channels and providers default to empty if omitted.
     *
     * @param array{
     *   name: string,
     *   routing: MessageRouting|MessageRoutingShape,
     *   channels?: array<string,Channel|ChannelShape>|null,
     *   description?: string|null,
     *   providers?: array<string,MessageProvidersType|MessageProvidersTypeShape>|null,
     *   tags?: list<string>|null,
     * }|RoutingStrategyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyMutationResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RoutingStrategyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingStrategyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'routing-strategies',
            body: (object) $parsed,
            options: $options,
            convert: RoutingStrategyMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a routing strategy by ID. Returns the full entity including routing content and metadata.
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['routing-strategies/%1$s', $id],
            options: $requestOptions,
            convert: RoutingStrategyGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List routing strategies in your workspace. Returns metadata only (no routing/channels/providers content). Use GET /routing-strategies/{id} for full details.
     *
     * @param array{
     *   cursor?: string|null, limit?: int
     * }|RoutingStrategyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RoutingStrategyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingStrategyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'routing-strategies',
            query: $parsed,
            options: $options,
            convert: RoutingStrategyListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a routing strategy. The strategy must not have associated notification templates. Unlink all templates before archiving.
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['routing-strategies/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * List notification templates associated with a routing strategy. Includes template metadata only, not full content.
     *
     * @param string $id routing strategy ID (`rs_` prefix)
     * @param array{
     *   cursor?: string|null, limit?: int
     * }|RoutingStrategyListNotificationsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssociatedNotificationListResponse>
     *
     * @throws APIException
     */
    public function listNotifications(
        string $id,
        array|RoutingStrategyListNotificationsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingStrategyListNotificationsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['routing-strategies/%1$s/notifications', $id],
            query: $parsed,
            options: $options,
            convert: AssociatedNotificationListResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace a routing strategy. Full document replacement; the caller must send the complete desired state. Missing optional fields are cleared.
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param array{
     *   name: string,
     *   routing: MessageRouting|MessageRoutingShape,
     *   channels?: array<string,Channel|ChannelShape>|null,
     *   description?: string|null,
     *   providers?: array<string,MessageProvidersType|MessageProvidersTypeShape>|null,
     *   tags?: list<string>|null,
     * }|RoutingStrategyReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyMutationResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        array|RoutingStrategyReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingStrategyReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['routing-strategies/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: RoutingStrategyMutationResponse::class,
        );
    }
}
