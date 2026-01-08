<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersParams;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListParams;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AudiencesRawContract
{
    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience_id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Audience>
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array<string,mixed>|AudienceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AudienceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array<string,mixed>|AudienceListMembersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceListMembersResponse>
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
