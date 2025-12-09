<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceStatus;
use Courier\RequestOptions;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

interface PreferencesContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier associated with the user whose preferences you wish to retrieve
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetResponse;

    /**
     * @api
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to retrieve
     * @param string|null $tenantID query param: Query the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        string $userID,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse;

    /**
     * @api
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to retrieve
     * @param array{
     *   status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *   customRouting?: list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null,
     *   hasCustomRouting?: bool|null,
     * } $topic Body param:
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        string $userID,
        array $topic,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse;
}
