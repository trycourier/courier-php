<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\Preferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\Preferences\ItemsRawContract;
use Courier\Tenants\Preferences\Items\ItemDeleteParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams\Status;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ItemsRawService implements ItemsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create or Replace Default Preferences For Topic
     *
     * @param string $topicID path param: Id fo the susbcription topic you want to have a default preference for
     * @param array{
     *   tenantID: string,
     *   status: Status|value-of<Status>,
     *   customRouting?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     *   hasCustomRouting?: bool|null,
     * }|ItemUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        array|ItemUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: [
                'tenants/%1$s/default_preferences/items/%2$s', $tenantID, $topicID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['tenantID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Remove Default Preferences For Topic
     *
     * @param string $topicID id fo the susbcription topic you want to have a default preference for
     * @param array{tenantID: string}|ItemDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        array|ItemDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'tenants/%1$s/default_preferences/items/%2$s', $tenantID, $topicID,
            ],
            options: $options,
            convert: null,
        );
    }
}
