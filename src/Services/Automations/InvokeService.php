<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\InvokeContract;

/**
 * @phpstan-import-type AutomationShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class InvokeService implements InvokeContract
{
    /**
     * @api
     */
    public InvokeRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InvokeRawService($client);
    }

    /**
     * @api
     *
     * Runs a series of automation steps supplied inline, without a saved template, and returns a runId.
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
    ): AutomationInvokeResponse {
        $params = Util::removeNulls(
            [
                'automation' => $automation,
                'brand' => $brand,
                'data' => $data,
                'profile' => $profile,
                'recipient' => $recipient,
                'template' => $template,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invokeAdHoc(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Starts an automation run from a saved template for one recipient, with optional data and profile, and returns a runId.
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
    ): AutomationInvokeResponse {
        $params = Util::removeNulls(
            [
                'recipient' => $recipient,
                'brand' => $brand,
                'data' => $data,
                'profile' => $profile,
                'template' => $template,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invokeByTemplate($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
