<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

interface PreferencesContract
{
    /**
     * @api
     *
     * @param array<mixed>|PreferenceRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|PreferenceRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|PreferenceRetrieveTopicParams $params
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        array|PreferenceRetrieveTopicParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse;

    /**
     * @api
     *
     * @param array<mixed>|PreferenceUpdateOrCreateTopicParams $params
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        array|PreferenceUpdateOrCreateTopicParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse;
}
