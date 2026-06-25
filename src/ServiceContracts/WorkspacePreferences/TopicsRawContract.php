<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\WorkspacePreferences;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\WorkspacePreferences\Topics\TopicArchiveParams;
use Courier\WorkspacePreferences\Topics\TopicCreateParams;
use Courier\WorkspacePreferences\Topics\TopicReplaceParams;
use Courier\WorkspacePreferences\Topics\TopicRetrieveParams;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TopicsRawContract
{
    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference to create the topic in
     * @param array<string,mixed>|TopicCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
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
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
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
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicListResponse>
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
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $topicID,
        array|TopicReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
