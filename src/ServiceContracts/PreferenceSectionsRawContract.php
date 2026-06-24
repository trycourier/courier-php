<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceSections\PreferenceSectionCreateParams;
use Courier\PreferenceSections\PreferenceSectionGetResponse;
use Courier\PreferenceSections\PreferenceSectionListResponse;
use Courier\PreferenceSections\PreferenceSectionReplaceParams;
use Courier\PreferenceSections\PublishPreferencesResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface PreferenceSectionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PreferenceSectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PreferenceSectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
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
     * @return BaseResponse<PreferenceSectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the preference section
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
     * @param string $sectionID id of the preference section
     * @param array<string,mixed>|PreferenceSectionReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        array|PreferenceSectionReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
