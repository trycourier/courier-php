<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\RoutingStrategies\AssociatedNotificationListResponse;
use Courier\RoutingStrategies\RoutingStrategyCreateParams;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListNotificationsParams;
use Courier\RoutingStrategies\RoutingStrategyListParams;
use Courier\RoutingStrategies\RoutingStrategyListResponse;
use Courier\RoutingStrategies\RoutingStrategyReplaceParams;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RoutingStrategiesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RoutingStrategyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyGetResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RoutingStrategyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RoutingStrategyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RoutingStrategyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id routing strategy ID (`rs_` prefix)
     * @param array<string,mixed>|RoutingStrategyListNotificationsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id routing strategy ID (rs_ prefix)
     * @param array<string,mixed>|RoutingStrategyReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingStrategyGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $id,
        array|RoutingStrategyReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
