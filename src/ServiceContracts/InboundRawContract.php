<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Inbound\InboundTrackEventParams;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;

interface InboundRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundTrackEventParams $params
     *
     * @return BaseResponse<InboundTrackEventResponse>
     *
     * @throws APIException
     */
    public function trackEvent(
        array|InboundTrackEventParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
