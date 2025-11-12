<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Inbound\InboundTrackEventParams;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;

interface InboundContract
{
    /**
     * @api
     *
     * @param array<mixed>|InboundTrackEventParams $params
     *
     * @throws APIException
     */
    public function trackEvent(
        array|InboundTrackEventParams $params,
        ?RequestOptions $requestOptions = null,
    ): InboundTrackEventResponse;
}
