<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\Filter;
use Courier\Audiences\Filter\Operator;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesContract;

final class AudiencesService implements AudiencesContract
{
    /**
     * @api
     */
    public AudiencesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AudiencesRawService($client);
    }

    /**
     * @api
     *
     * Returns the specified audience by id.
     *
     * @param string $audienceID A unique identifier representing the audience_id
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): Audience {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($audienceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates or updates audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $description A description of the audience
     * @param array{
     *   operator: 'ENDS_WITH'|'EQ'|'EXISTS'|'GT'|'GTE'|'INCLUDES'|'IS_AFTER'|'IS_BEFORE'|'LT'|'LTE'|'NEQ'|'OMIT'|'STARTS_WITH'|'AND'|'OR'|Operator,
     *   path: string,
     *   value: string,
     * }|Filter|null $filter A single filter to use for filtering
     * @param string|null $name The name of the audience
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        ?string $description = null,
        array|Filter|null $filter = null,
        ?string $name = null,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse {
        $params = [
            'description' => $description, 'filter' => $filter, 'name' => $name,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($audienceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the audiences associated with the authorization token.
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse {
        $params = ['cursor' => $cursor];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes the specified audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($audienceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get list of members of an audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $cursor A unique identifier that allows for fetching the next set of members
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse {
        $params = ['cursor' => $cursor];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listMembers($audienceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
