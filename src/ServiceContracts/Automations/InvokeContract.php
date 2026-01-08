<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type AutomationShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface InvokeContract
{
    /**
     * @api
     *
     * @param Automation|AutomationShape $automation
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        Automation|array $automation,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $recipient = null,
        ?string $template = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param string $templateID A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        ?string $recipient,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $template = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutomationInvokeResponse;
}
