<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Feedback\FeedbackCreateParams;
use Courier\Feedback\FeedbackCreateParams\Category;
use Courier\Feedback\FeedbackCreateParams\Surface;
use Courier\Feedback\FeedbackNewResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\FeedbackRawContract;

/**
 * Report suspected bugs, confusing behavior and missing features in Courier, from an AI agent, a developer tool or by hand.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class FeedbackRawService implements FeedbackRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Reports a suspected bug, confusing behavior or a missing feature in Courier. It is built for AI agents and developer tools to call when Courier does something unexpected, and people can call it too.
     *
     * A report is not a support ticket. A `201` means Courier stored the report; it does not promise a reply or a fix. For help with your account, contact Courier support.
     *
     * Never include secrets, API keys or customer data such as recipient names, email addresses or message content.
     *
     * Requires an API key with no scope restrictions; a JWT or a scoped API key is refused. Each workspace can submit 200 reports per UTC day, and requests that fail validation count toward that limit.
     *
     * @param array{
     *   category: Category|value-of<Category>,
     *   description: string,
     *   surface: Surface|value-of<Surface>,
     *   title: string,
     *   expectedBehavior?: string,
     *   harness?: string,
     *   location?: string,
     *   model?: string,
     *   requestID?: string,
     * }|FeedbackCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeedbackNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FeedbackCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FeedbackCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'feedback',
            body: (object) $parsed,
            options: $options,
            convert: FeedbackNewResponse::class,
        );
    }
}
