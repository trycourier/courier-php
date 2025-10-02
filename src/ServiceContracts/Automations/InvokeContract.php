<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\Invoke\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface InvokeContract
{
    /**
     * @api
     *
     * @param Automation $automation
     * @param string|null $brand
     * @param array<string, mixed>|null $data
     * @param mixed $profile
     * @param string|null $recipient
     * @param string|null $template
     *
     * @return AutomationInvokeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        $automation,
        $brand = omit,
        $data = omit,
        $profile = omit,
        $recipient = omit,
        $template = omit,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AutomationInvokeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function invokeAdHocRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param string|null $brand
     * @param array<string, mixed>|null $data
     * @param mixed $profile
     * @param string|null $recipient
     * @param string|null $template
     *
     * @return AutomationInvokeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        $brand = omit,
        $data = omit,
        $profile = omit,
        $recipient = omit,
        $template = omit,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AutomationInvokeResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function invokeByTemplateRaw(
        string $templateID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;
}
