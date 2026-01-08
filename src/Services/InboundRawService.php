<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Inbound\InboundTrackEventParams;
use Courier\Inbound\InboundTrackEventParams\Type;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\InboundRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class InboundRawService implements InboundRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Courier Track Event
     *
     * @param array{
     *   event: string,
     *   messageID: string,
     *   properties: array<string,mixed>,
     *   type: Type|value-of<Type>,
     *   userID?: string|null,
     * }|InboundTrackEventParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundTrackEventResponse>
     *
     * @throws APIException
     */
    public function trackEvent(
        array|InboundTrackEventParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundTrackEventParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'inbound/courier',
            body: (object) $parsed,
            options: $options,
            convert: InboundTrackEventResponse::class,
        );
    }
}
