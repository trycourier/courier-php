<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Inbound\InboundTrackEventParams;
use Courier\Inbound\InboundTrackEventResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface InboundRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundTrackEventParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundTrackEventResponse>
     *
     * @throws APIException
     */
    public function trackEvent(
        array|InboundTrackEventParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
