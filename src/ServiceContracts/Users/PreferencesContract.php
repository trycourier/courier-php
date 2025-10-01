<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

use const Courier\Core\OMIT as omit;

interface PreferencesContract
{
    /**
     * @api
     *
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @return PreferenceGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetResponse;

    /**
     * @api
     *
     * @param string $userID
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @return PreferenceGetTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        $userID,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceGetTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveTopicRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetTopicResponse;

    /**
     * @api
     *
     * @param string $userID
     * @param Topic $topic
     * @param string|null $tenantID update the preferences of a user for this specific tenant context
     *
     * @return PreferenceUpdateOrNewTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        $userID,
        $topic,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceUpdateOrNewTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopicRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceUpdateOrNewTopicResponse;
}
