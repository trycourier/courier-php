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
use Courier\ServiceContracts\InboundContract;

final class InboundService implements InboundContract
{
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
     *   messageId: string,
     *   properties: array<string,mixed>,
     *   type: 'track'|Type,
     *   userId?: string|null,
     * }|InboundTrackEventParams $params
     *
     * @throws APIException
     */
    public function trackEvent(
        array|InboundTrackEventParams $params,
        ?RequestOptions $requestOptions = null,
    ): InboundTrackEventResponse {
        [$parsed, $options] = InboundTrackEventParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<InboundTrackEventResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'inbound/courier',
            body: (object) $parsed,
            options: $options,
            convert: InboundTrackEventResponse::class,
        );

        return $response->parse();
    }
}
