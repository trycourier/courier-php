<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Automations\AutomationListParams;
use Courier\Automations\AutomationTemplateListResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AutomationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AutomationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationTemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AutomationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
