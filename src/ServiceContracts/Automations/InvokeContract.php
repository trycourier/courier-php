<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams;
use Courier\Automations\Invoke\InvokeInvokeByTemplateParams;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface InvokeContract
{
    /**
     * @api
     *
     * @param array<mixed>|InvokeInvokeAdHocParams $params
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        array|InvokeInvokeAdHocParams $params,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param array<mixed>|InvokeInvokeByTemplateParams $params
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        array|InvokeInvokeByTemplateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;
}
