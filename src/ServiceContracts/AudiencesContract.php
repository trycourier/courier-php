<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\Filter\UnionMember0;
use Courier\Audiences\NestedFilterConfig;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface AudiencesContract
{
    /**
     * @api
     *
     * @return Audience<HasRawResponse>
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
     * @return Audience<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $audienceID,
        mixed $params,
        ?RequestOptions $requestOptions = null,
    ): Audience;

    /**
     * @api
     *
     * @param string|null $description A description of the audience
     * @param UnionMember0|NestedFilterConfig|null $filter The operator to use for filtering
     * @param string|null $name The name of the audience
     *
     * @return AudienceUpdateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        $description = omit,
        $filter = omit,
        $name = omit,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AudienceUpdateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $audienceID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse;

    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     *
     * @return AudienceListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AudienceListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
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
     * @throws APIException
     */
    public function deleteRaw(
        string $audienceID,
        mixed $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of members
     *
     * @return AudienceListMembersResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AudienceListMembersResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listMembersRaw(
        string $audienceID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse;
}
