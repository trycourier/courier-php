<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyInvokeParams;
use Courier\Journeys\JourneyListParams;
use Courier\Journeys\JourneyListParams\Version;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\JourneysRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class JourneysRawService implements JourneysRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the list of journeys.
     *
     * @param array{
     *   cursor?: string, version?: Version|value-of<Version>
     * }|JourneyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|JourneyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'journeys',
            query: $parsed,
            options: $options,
            convert: JourneysListResponse::class,
        );
    }

    /**
     * @api
     *
     * Invoke a journey run from a journey template.
     *
     * @param string $templateID A unique identifier representing the journey template to be invoked. This could be the Journey Template ID or the Journey Template Alias.
     * @param array{
     *   data?: array<string,mixed>, profile?: array<string,mixed>, userID?: string
     * }|JourneyInvokeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysInvokeResponse>
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        array|JourneyInvokeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyInvokeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/invoke', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: JourneysInvokeResponse::class,
        );
    }
}
