<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Feedback\FeedbackCreateParams\Category;
use Courier\Feedback\FeedbackCreateParams\Surface;
use Courier\Feedback\FeedbackNewResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface FeedbackContract
{
    /**
     * @api
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
    ): FeedbackNewResponse;
}
