<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\Preferences\Items\ItemUpdateParams\Status;

interface ItemsContract
{
    /**
     * @api
     *
     * @param string $topicID path param: Id fo the susbcription topic you want to have a default preference for
     * @param string $tenantID path param: Id of the tenant to update the default preferences for
     * @param 'OPTED_OUT'|'OPTED_IN'|'REQUIRED'|Status $status Body param:
     * @param list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null $customRouting Body param: The default channels to send to this tenant when has_custom_routing is enabled
     * @param bool|null $hasCustomRouting Body param: Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        string $tenantID,
        string|Status $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $topicID id fo the susbcription topic you want to have a default preference for
     * @param string $tenantID id of the tenant to update the default preferences for
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        string $tenantID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
