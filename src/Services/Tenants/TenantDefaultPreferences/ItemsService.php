<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\TenantDefaultPreferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TenantDefaultPreferences\ItemsContract;
use Courier\Tenants\TenantDefaultPreferences\Items\ItemDeleteParams;
use Courier\Tenants\TenantDefaultPreferences\Items\ItemUpdateParams;
use Courier\Tenants\TenantDefaultPreferences\Items\ItemUpdateParams\Status;

use const Courier\Core\OMIT as omit;

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
     * @param string $tenantID
     * @param Status|value-of<Status> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting The default channels to send to this tenant when has_custom_routing is enabled
     * @param bool|null $hasCustomRouting Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        $tenantID,
        $status,
        $customRouting = omit,
        $hasCustomRouting = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = [
            'tenantID' => $tenantID,
            'status' => $status,
            'customRouting' => $customRouting,
            'hasCustomRouting' => $hasCustomRouting,
        ];

        return $this->updateRaw($topicID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = ItemUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: [
                'tenants/%1$s/default_preferences/items/%2$s', $tenantID, $topicID,
            ],
            body: (object) array_diff_key($parsed, ['tenantID']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Remove Default Preferences For Topic
     *
     * @param string $tenantID
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['tenantID' => $tenantID];

        return $this->deleteRaw($topicID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = ItemDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line;
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
