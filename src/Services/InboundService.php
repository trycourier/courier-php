<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Inbound\InboundTrackEventParams;
use Courier\Inbound\InboundTrackEventParams\Type;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\InboundContract;

use const Courier\Core\OMIT as omit;

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
     * @param string $event A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     * @param string $messageID A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status
     * @param array<string, mixed> $properties
     * @param Type|value-of<Type> $type
     * @param string|null $userID The user id associated with the track
     *
     * @return InboundTrackEventResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function trackEvent(
        $event,
        $messageID,
        $properties,
        $type,
        $userID = omit,
        ?RequestOptions $requestOptions = null,
    ): InboundTrackEventResponse {
        $params = [
            'event' => $event,
            'messageID' => $messageID,
            'properties' => $properties,
            'type' => $type,
            'userID' => $userID,
        ];

        return $this->trackEventRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return InboundTrackEventResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function trackEventRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): InboundTrackEventResponse {
        [$parsed, $options] = InboundTrackEventParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'inbound/courier',
            body: (object) $parsed,
            options: $options,
            convert: InboundTrackEventResponse::class,
        );
    }
}
