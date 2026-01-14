<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\Preferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\Preferences\ItemsContract;
use Courier\Tenants\Preferences\Items\ItemUpdateParams\Status;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ItemsService implements ItemsContract
{
    /**
     * @api
     */
    public ItemsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ItemsRawService($client);
    }

    /**
     * @api
     *
     * Create or Replace Default Preferences For Topic
     *
     * @param string $topicID path param: Id of the subscription topic you want to have a default preference for
     * @param string $tenantID path param: Id of the tenant to update the default preferences for
     * @param Status|value-of<Status> $status Body param
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting Body param: The default channels to send to this tenant when has_custom_routing is enabled
     * @param bool|null $hasCustomRouting Body param: Override channel routing with custom preferences. This will override any template preferences that are set, but a user can still customize their preferences
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        string $tenantID,
        Status|string $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'tenantID' => $tenantID,
                'status' => $status,
                'customRouting' => $customRouting,
                'hasCustomRouting' => $hasCustomRouting,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove Default Preferences For Topic
     *
     * @param string $topicID id of the subscription topic you want to have a default preference for
     * @param string $tenantID id of the tenant to update the default preferences for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        string $tenantID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['tenantID' => $tenantID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
