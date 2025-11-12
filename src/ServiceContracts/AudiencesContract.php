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
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AudiencesContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): Audience;

    /**
     * @api
     *
     * @param array<mixed>|AudienceUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse;

    /**
     * @api
     *
     * @param array<mixed>|AudienceListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|AudienceListMembersParams $params
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse;
}
