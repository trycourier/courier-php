<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\Invoke\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Automations\Invoke\InvokeInvokeByTemplateParams;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\InvokeContract;

use const Courier\Core\OMIT as omit;

final class InvokeService implements InvokeContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Invoke an ad hoc automation run. This endpoint accepts a JSON payload with a series of automation steps. For information about what steps are available, checkout the ad hoc automation guide [here](https://www.courier.com/docs/automations/steps/).
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
    ): AutomationInvokeResponse {
        $params = [
            'automation' => $automation,
            'brand' => $brand,
            'data' => $data,
            'profile' => $profile,
            'recipient' => $recipient,
            'template' => $template,
        ];

        return $this->invokeAdHocRaw($params, $requestOptions);
    }

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
    ): AutomationInvokeResponse {
        [$parsed, $options] = InvokeInvokeAdHocParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'automations/invoke',
            body: (object) $parsed,
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }

    /**
     * @api
     *
     * Invoke an automation run from an automation template.
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
    ): AutomationInvokeResponse {
        $params = [
            'brand' => $brand,
            'data' => $data,
            'profile' => $profile,
            'recipient' => $recipient,
            'template' => $template,
        ];

        return $this->invokeByTemplateRaw($templateID, $params, $requestOptions);
    }

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
        ?RequestOptions $requestOptions = null
    ): AutomationInvokeResponse {
        [$parsed, $options] = InvokeInvokeByTemplateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['automations/%1$s/invoke', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }
}
