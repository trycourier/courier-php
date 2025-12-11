<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Inbound\InboundTrackEventParams\Type;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\InboundContract;

final class InboundService implements InboundContract
{
    /**
     * @api
     */
    public InboundRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundRawService($client);
    }

    /**
     * @api
     *
     * Courier Track Event
     *
     * @param string $event A descriptive name of the event. This name will appear as a trigger in the Courier Automation Trigger node.
     * @param string $messageID A required unique identifier that will be used to de-duplicate requests. If not unique, will respond with 409 Conflict status
     * @param array<string,mixed> $properties
     * @param 'track'|Type $type
     * @param string|null $userID The user id associatiated with the track
     *
     * @throws APIException
     */
    public function trackEvent(
        string $event,
        string $messageID,
        array $properties,
        string|Type $type,
        ?string $userID = null,
        ?RequestOptions $requestOptions = null,
    ): InboundTrackEventResponse {
        $params = Util::removeNulls(
            [
                'event' => $event,
                'messageID' => $messageID,
                'properties' => $properties,
                'type' => $type,
                'userID' => $userID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->trackEvent(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
