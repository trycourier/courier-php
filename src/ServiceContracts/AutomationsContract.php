<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Automations\AutomationInvokeAdHocParams\Automation;
use Courier\Automations\Invoke\AutomationInvokeResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface AutomationsContract
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
     * @param string|null $brand
     * @param array<string, mixed>|null $data
     * @param mixed $profile
     * @param string|null $recipient
     * @param string|null $template
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
     * @throws APIException
     */
    public function invokeByTemplateRaw(
        string $templateID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;
}
