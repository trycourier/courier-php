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

interface AudiencesRawContract
{
    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience_id
     *
     * @return BaseResponse<Audience>
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array<mixed>|AudienceUpdateParams $params
     *
     * @return BaseResponse<AudienceUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|AudienceListParams $params
     *
     * @return BaseResponse<AudienceListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array<mixed>|AudienceListMembersParams $params
     *
     * @return BaseResponse<AudienceListMembersResponse>
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
