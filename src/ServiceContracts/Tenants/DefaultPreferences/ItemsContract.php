<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\DefaultPreferences;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\Tenants\DefaultPreferences\Items\ItemUpdateParams\Status;

use const Courier\Core\OMIT as omit;

interface ItemsContract
{
    /**
     * @api
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
    ): mixed;

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
    ): mixed;

    /**
     * @api
     *
     * @param string $tenantID
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
    ): mixed;
}
