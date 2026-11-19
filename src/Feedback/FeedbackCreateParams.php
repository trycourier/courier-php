<?php

declare(strict_types=1);

namespace Courier\Feedback;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Feedback\FeedbackCreateParams\Category;
use Courier\Feedback\FeedbackCreateParams\Surface;

/**
 * Reports a suspected bug, confusing behavior or a missing feature in Courier. It is built for AI agents and developer tools to call when Courier does something unexpected, and people can call it too.
 *
 * A report is not a support ticket. A `201` means Courier stored the report; it does not promise a reply or a fix. For help with your account, contact Courier support.
 *
 * Never include secrets, API keys or customer data such as recipient names, email addresses or message content.
 *
 * Requires an API key with no scope restrictions; a JWT or a scoped API key is refused. Each workspace can submit 200 reports per UTC day, and requests that fail validation count toward that limit.
 *
 * @see Courier\Services\FeedbackService::create()
 *
 * @phpstan-type FeedbackCreateParamsShape = array{
 *   category: Category|value-of<Category>,
 *   description: string,
 *   surface: Surface|value-of<Surface>,
 *   title: string,
 *   expectedBehavior?: string|null,
 *   harness?: string|null,
 *   location?: string|null,
 *   model?: string|null,
 *   requestID?: string|null,
 * }
 */
final class FeedbackCreateParams implements BaseModel
{
    /** @use SdkModel<FeedbackCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * What kind of report this is: `possible_bug` for behavior that looks wrong, `confusing_behavior` for behavior that works but was hard to understand, `feature_request` for something Courier does not do yet, and `other`.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * What happened, in enough detail for someone at Courier to follow it.
     */
    #[Required]
    public string $description;

    /**
     * Where you met the problem: the REST `api`, an `sdk`, the Courier `mcp` server, the Courier app `ui`, the `docs`, or `other`.
     *
     * @var value-of<Surface> $surface
     */
    #[Required(enum: Surface::class)]
    public string $surface;

    /**
     * A one-line summary of the report.
     */
    #[Required]
    public string $title;

    /**
     * What you expected to happen instead.
     */
    #[Optional('expected_behavior')]
    public ?string $expectedBehavior;

    /**
     * The agent or tool that submitted the report, such as `Claude Code`.
     */
    #[Optional]
    public ?string $harness;

    /**
     * Where it happened, such as an endpoint (`POST /send`), an SDK method, an MCP tool name or a docs URL.
     */
    #[Optional]
    public ?string $location;

    /**
     * The AI model that submitted the report, such as `claude-opus-5-5`.
     */
    #[Optional]
    public ?string $model;

    /**
     * The request ID of an API call that shows the problem, if there is one.
     */
    #[Optional('request_id')]
    public ?string $requestID;

    /**
     * `new FeedbackCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeedbackCreateParams::with(
     *   category: ..., description: ..., surface: ..., title: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeedbackCreateParams)
     *   ->withCategory(...)
     *   ->withDescription(...)
     *   ->withSurface(...)
     *   ->withTitle(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Category|value-of<Category> $category
     * @param Surface|value-of<Surface> $surface
     */
    public static function with(
        Category|string $category,
        string $description,
        Surface|string $surface,
        string $title,
        ?string $expectedBehavior = null,
        ?string $harness = null,
        ?string $location = null,
        ?string $model = null,
        ?string $requestID = null,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['description'] = $description;
        $self['surface'] = $surface;
        $self['title'] = $title;

        null !== $expectedBehavior && $self['expectedBehavior'] = $expectedBehavior;
        null !== $harness && $self['harness'] = $harness;
        null !== $location && $self['location'] = $location;
        null !== $model && $self['model'] = $model;
        null !== $requestID && $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * What kind of report this is: `possible_bug` for behavior that looks wrong, `confusing_behavior` for behavior that works but was hard to understand, `feature_request` for something Courier does not do yet, and `other`.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * What happened, in enough detail for someone at Courier to follow it.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Where you met the problem: the REST `api`, an `sdk`, the Courier `mcp` server, the Courier app `ui`, the `docs`, or `other`.
     *
     * @param Surface|value-of<Surface> $surface
     */
    public function withSurface(Surface|string $surface): self
    {
        $self = clone $this;
        $self['surface'] = $surface;

        return $self;
    }

    /**
     * A one-line summary of the report.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * What you expected to happen instead.
     */
    public function withExpectedBehavior(string $expectedBehavior): self
    {
        $self = clone $this;
        $self['expectedBehavior'] = $expectedBehavior;

        return $self;
    }

    /**
     * The agent or tool that submitted the report, such as `Claude Code`.
     */
    public function withHarness(string $harness): self
    {
        $self = clone $this;
        $self['harness'] = $harness;

        return $self;
    }

    /**
     * Where it happened, such as an endpoint (`POST /send`), an SDK method, an MCP tool name or a docs URL.
     */
    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * The AI model that submitted the report, such as `claude-opus-5-5`.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * The request ID of an API call that shows the problem, if there is one.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }
}
