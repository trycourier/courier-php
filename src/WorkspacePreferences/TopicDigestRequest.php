<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A topic's digest configuration: the template that renders it, the cadences it delivers on, and how collected events are retained.
 *
 * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected -- both states are un-deliverable rather than merely off.
 *
 * @phpstan-import-type TopicDigestScheduleRequestShape from \Courier\WorkspacePreferences\TopicDigestScheduleRequest
 * @phpstan-import-type TopicDigestCategoryShape from \Courier\WorkspacePreferences\TopicDigestCategory
 *
 * @phpstan-type TopicDigestRequestShape = array{
 *   schedules: list<TopicDigestScheduleRequest|TopicDigestScheduleRequestShape>,
 *   templateID: string,
 *   audienceID?: string|null,
 *   categories?: list<TopicDigestCategory|TopicDigestCategoryShape>|null,
 *   triggerEmpty?: bool|null,
 * }
 */
final class TopicDigestRequest implements BaseModel
{
    /** @use SdkModel<TopicDigestRequestShape> */
    use SdkModel;

    /**
     * The cadences this digest delivers on. At least one is required: a digest with no schedule collects events into an instance that can never fire. Omitting the key on a replace leaves stored schedules untouched; sending `[]` is a `400`.
     *
     * @var list<TopicDigestScheduleRequest> $schedules
     */
    #[Required(list: TopicDigestScheduleRequest::class)]
    public array $schedules;

    /**
     * The notification template that renders the digest. A digest with no template collects nothing, so this is required.
     */
    #[Required('template_id')]
    public string $templateID;

    /**
     * Optional audience the digest is scoped to.
     */
    #[Optional('audience_id')]
    public ?string $audienceID;

    /**
     * Retention rules per category key. Defaults to a single `digest` category retaining `FIRST`.
     *
     * @var list<TopicDigestCategory>|null $categories
     */
    #[Optional(list: TopicDigestCategory::class)]
    public ?array $categories;

    /**
     * Whether to deliver the digest even when nothing was collected.
     */
    #[Optional('trigger_empty')]
    public ?bool $triggerEmpty;

    /**
     * `new TopicDigestRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestRequest::with(schedules: ..., templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestRequest)->withSchedules(...)->withTemplateID(...)
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
     * @param list<TopicDigestScheduleRequest|TopicDigestScheduleRequestShape> $schedules
     * @param list<TopicDigestCategory|TopicDigestCategoryShape>|null $categories
     */
    public static function with(
        array $schedules,
        string $templateID,
        ?string $audienceID = null,
        ?array $categories = null,
        ?bool $triggerEmpty = null,
    ): self {
        $self = new self;

        $self['schedules'] = $schedules;
        $self['templateID'] = $templateID;

        null !== $audienceID && $self['audienceID'] = $audienceID;
        null !== $categories && $self['categories'] = $categories;
        null !== $triggerEmpty && $self['triggerEmpty'] = $triggerEmpty;

        return $self;
    }

    /**
     * The cadences this digest delivers on. At least one is required: a digest with no schedule collects events into an instance that can never fire. Omitting the key on a replace leaves stored schedules untouched; sending `[]` is a `400`.
     *
     * @param list<TopicDigestScheduleRequest|TopicDigestScheduleRequestShape> $schedules
     */
    public function withSchedules(array $schedules): self
    {
        $self = clone $this;
        $self['schedules'] = $schedules;

        return $self;
    }

    /**
     * The notification template that renders the digest. A digest with no template collects nothing, so this is required.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * Optional audience the digest is scoped to.
     */
    public function withAudienceID(string $audienceID): self
    {
        $self = clone $this;
        $self['audienceID'] = $audienceID;

        return $self;
    }

    /**
     * Retention rules per category key. Defaults to a single `digest` category retaining `FIRST`.
     *
     * @param list<TopicDigestCategory|TopicDigestCategoryShape> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * Whether to deliver the digest even when nothing was collected.
     */
    public function withTriggerEmpty(bool $triggerEmpty): self
    {
        $self = clone $this;
        $self['triggerEmpty'] = $triggerEmpty;

        return $self;
    }
}
