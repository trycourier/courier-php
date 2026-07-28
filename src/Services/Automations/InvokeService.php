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
     * @param Automation|AutomationShape $automation Body param
     * @param string|null $brand Body param
     * @param array<string,mixed>|null $data Body param
     * @param array<string,mixed>|null $profile Body param
     * @param string|null $recipient Body param
     * @param string|null $template Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
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
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
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
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
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
     * @param string $templateID Path param: A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param string|null $recipient Body param
     * @param string|null $brand Body param
     * @param array<string,mixed>|null $data Body param
     * @param array<string,mixed>|null $profile Body param
     * @param string|null $template Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
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
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutomationInvokeResponse {
        $params = Util::removeNulls(
            [
                'recipient' => $recipient,
                'brand' => $brand,
                'data' => $data,
                'profile' => $profile,
                'template' => $template,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invokeByTemplate($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
