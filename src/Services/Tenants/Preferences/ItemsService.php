<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\Preferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\Preferences\ItemsContract;
use Courier\Tenants\Preferences\Items\ItemDeleteParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams\Status;

final class ItemsService implements ItemsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create or Replace Default Preferences For Topic
     *
     * @param array{
     *   tenantID: string,
     *   status: 'OPTED_OUT'|'OPTED_IN'|'REQUIRED'|Status,
     *   customRouting?: list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null,
     *   hasCustomRouting?: bool|null,
     * }|ItemUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        array|ItemUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = ItemUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'put',
            path: [
                'tenants/%1$s/default_preferences/items/%2$s', $tenantID, $topicID,
            ],
            body: (object) array_diff_key($parsed, ['tenantID']),
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove Default Preferences For Topic
     *
     * @param array{tenantID: string}|ItemDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        array|ItemDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = ItemDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: [
                'tenants/%1$s/default_preferences/items/%2$s', $tenantID, $topicID,
            ],
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
