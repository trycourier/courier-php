<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Feedback\FeedbackCreateParams\Category;
use Courier\Feedback\FeedbackCreateParams\Surface;
use Courier\Feedback\FeedbackNewResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\FeedbackContract;

/**
 * Report suspected bugs, confusing behavior and missing features in Courier, from an AI agent, a developer tool or by hand.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class FeedbackService implements FeedbackContract
{
    /**
     * @api
     */
    public FeedbackRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FeedbackRawService($client);
    }

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
     * @param Category|value-of<Category> $category what kind of report this is: `possible_bug` for behavior that looks wrong, `confusing_behavior` for behavior that works but was hard to understand, `feature_request` for something Courier does not do yet, and `other`
     * @param string $description what happened, in enough detail for someone at Courier to follow it
     * @param Surface|value-of<Surface> $surface where you met the problem: the REST `api`, an `sdk`, the Courier `mcp` server, the Courier app `ui`, the `docs`, or `other`
     * @param string $title a one-line summary of the report
     * @param string $expectedBehavior what you expected to happen instead
     * @param string $harness the agent or tool that submitted the report, such as `Claude Code`
     * @param string $location where it happened, such as an endpoint (`POST /send`), an SDK method, an MCP tool name or a docs URL
     * @param string $model the AI model that submitted the report, such as `claude-opus-5-5`
     * @param string $requestID the request ID of an API call that shows the problem, if there is one
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Category|string $category,
        string $description,
        Surface|string $surface,
        string $title,
        ?string $expectedBehavior = null,
        ?string $harness = null,
        ?string $location = null,
        ?string $model = null,
        ?string $requestID = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeedbackNewResponse {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'description' => $description,
                'surface' => $surface,
                'title' => $title,
                'expectedBehavior' => $expectedBehavior,
                'harness' => $harness,
                'location' => $location,
                'model' => $model,
                'requestID' => $requestID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
