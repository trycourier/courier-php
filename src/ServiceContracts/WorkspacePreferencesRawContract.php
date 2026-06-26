<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\WorkspacePreferences\PublishPreferencesResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceCreateParams;
use Courier\WorkspacePreferences\WorkspacePreferenceGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceListResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceReplaceParams;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface WorkspacePreferencesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WorkspacePreferenceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WorkspacePreferenceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PublishPreferencesResponse>
     *
     * @throws APIException
     */
    public function publish(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param array<string,mixed>|WorkspacePreferenceReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        array|WorkspacePreferenceReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
