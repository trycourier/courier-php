<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface InvokeContract
{
    /**
     * @api
     *
     * @param array{
     *   steps: list<array<string,mixed>>, cancelationToken?: string|null
     * } $automation
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        array $automation,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $recipient = null,
        ?string $template = null,
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;

    /**
     * @api
     *
     * @param string $templateID A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
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
        ?RequestOptions $requestOptions = null,
    ): AutomationInvokeResponse;
}
