<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams;
use Courier\Automations\Invoke\InvokeInvokeByTemplateParams;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface InvokeRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|InvokeInvokeAdHocParams $params
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        array|InvokeInvokeAdHocParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param array<mixed>|InvokeInvokeByTemplateParams $params
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        array|InvokeInvokeByTemplateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
