<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Users;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface PreferencesRawContract
{
    /**
     * @api
     *
     * @param string $userID a unique identifier associated with the user whose preferences you wish to retrieve
     * @param array<string,mixed>|PreferenceRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|PreferenceRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param array<string,mixed>|PreferenceRetrieveTopicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceGetTopicResponse>
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        array|PreferenceRetrieveTopicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param array<string,mixed>|PreferenceUpdateOrCreateTopicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceUpdateOrNewTopicResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        array|PreferenceUpdateOrCreateTopicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
