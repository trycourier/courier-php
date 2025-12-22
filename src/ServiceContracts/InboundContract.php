<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Inbound\InboundTrackEventParams\Type;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;

interface InboundContract
{
    /**
     * @api
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
    ): InboundTrackEventResponse;
}
