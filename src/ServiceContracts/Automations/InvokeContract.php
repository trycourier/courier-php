<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\Invoke\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Core\Exceptions\APIException;
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
     * @param array<string, mixed>|null $profile
     * @param string|null $recipient
     * @param string|null $template
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
     * @throws APIException
     */
    public function invokeAdHocRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param string|null $recipient
     * @param string|null $brand
     * @param array<string, mixed>|null $data
     * @param array<string, mixed>|null $profile
     * @param string|null $template
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        $recipient,
        $brand = omit,
        $data = omit,
        $profile = omit,
        $template = omit,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function invokeByTemplateRaw(
        string $templateID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;
}
