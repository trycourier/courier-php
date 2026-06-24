<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\PreferenceSections;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceSections\PreferenceTopicGetResponse;
use Courier\PreferenceSections\PreferenceTopicListResponse;
use Courier\PreferenceSections\Topics\TopicArchiveParams;
use Courier\PreferenceSections\Topics\TopicCreateParams;
use Courier\PreferenceSections\Topics\TopicReplaceParams;
use Courier\PreferenceSections\Topics\TopicRetrieveParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TopicsRawContract
{
    /**
     * @api
     *
     * @param string $sectionID id of the preference section to create the topic in
     * @param array<string,mixed>|TopicCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function create(
        string $sectionID,
        array|TopicCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID id of the subscription preference topic
     * @param array<string,mixed>|TopicRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $topicID,
        array|TopicRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID id of the subscription preference topic
     * @param array<string,mixed>|TopicArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $topicID,
        array|TopicArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID path param: Id of the subscription preference topic
     * @param array<string,mixed>|TopicReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $topicID,
        array|TopicReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
