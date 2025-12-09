<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\InvokeContract;

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
     * Invoke an ad hoc automation run. This endpoint accepts a JSON payload with a series of automation steps. For information about what steps are available, checkout the ad hoc automation guide [here](https://www.courier.com/docs/automations/steps/).
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
    ): AutomationInvokeResponse {
        $params = [
            'automation' => $automation,
            'brand' => $brand,
            'data' => $data,
            'profile' => $profile,
            'recipient' => $recipient,
            'template' => $template,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invokeAdHoc(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Invoke an automation run from an automation template.
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
    ): AutomationInvokeResponse {
        $params = [
            'recipient' => $recipient,
            'brand' => $brand,
            'data' => $data,
            'profile' => $profile,
            'template' => $template,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invokeByTemplate($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
