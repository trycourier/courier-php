<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Feedback\FeedbackCreateParams;
use Courier\Feedback\FeedbackNewResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface FeedbackRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FeedbackCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeedbackNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FeedbackCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
