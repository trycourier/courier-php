<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersParams;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListParams;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\Filter;
use Courier\Audiences\Filter\Operator;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesRawContract;

final class AudiencesRawService implements AudiencesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the specified audience by id.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: Audience::class,
        );
    }

    /**
     * @api
     *
     * Creates or updates audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array{
     *   description?: string|null,
     *   filter?: array{
     *     operator: 'ENDS_WITH'|'EQ'|'EXISTS'|'GT'|'GTE'|'INCLUDES'|'IS_AFTER'|'IS_BEFORE'|'LT'|'LTE'|'NEQ'|'OMIT'|'STARTS_WITH'|'AND'|'OR'|Operator,
     *     path: string,
     *     value: string,
     *   }|Filter|null,
     *   name?: string|null,
     * }|AudienceUpdateParams $params
     *
     * @return BaseResponse<AudienceUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AudienceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['audiences/%1$s', $audienceID],
            body: (object) $parsed,
            options: $options,
            convert: AudienceUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Get the audiences associated with the authorization token.
     *
     * @param array{cursor?: string|null}|AudienceListParams $params
     *
     * @return BaseResponse<AudienceListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = AudienceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'audiences',
            query: $parsed,
            options: $options,
            convert: AudienceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes the specified audience.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get list of members of an audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array{cursor?: string|null}|AudienceListMembersParams $params
     *
     * @return BaseResponse<AudienceListMembersResponse>
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AudienceListMembersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['audiences/%1$s/members', $audienceID],
            query: $parsed,
            options: $options,
            convert: AudienceListMembersResponse::class,
        );
    }
}
