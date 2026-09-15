<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Digests\TopicDigestScheduleResponse;

/**
 * A topic's digest configuration.
 *
 * @phpstan-import-type TopicDigestCategoryShape from \Courier\WorkspacePreferences\TopicDigestCategory
 * @phpstan-import-type TopicDigestScheduleResponseShape from \Courier\Digests\TopicDigestScheduleResponse
 *
 * @phpstan-type TopicDigestResponseShape = array{
 *   categories: list<TopicDigestCategory|TopicDigestCategoryShape>,
 *   schedules: list<TopicDigestScheduleResponse|TopicDigestScheduleResponseShape>,
 *   templateID: string,
 *   audienceID?: string|null,
 *   created?: string|null,
 *   triggerEmpty?: bool|null,
 *   updated?: string|null,
 * }
 */
final class TopicDigestResponse implements BaseModel
{
    /** @use SdkModel<TopicDigestResponseShape> */
    use SdkModel;

    /**
     * Retention rules per category key.
     *
     * @var list<TopicDigestCategory> $categories
     */
    #[Required(list: TopicDigestCategory::class)]
    public array $categories;

    /**
     * The digest's delivery cadences, each with its server-assigned `schedule_id`.
     *
     * @var list<TopicDigestScheduleResponse> $schedules
     */
    #[Required(list: TopicDigestScheduleResponse::class)]
    public array $schedules;

    /**
     * The notification template that renders the digest.
     */
    #[Required('template_id')]
    public string $templateID;

    /**
     * The audience the digest is scoped to, when set.
     */
    #[Optional('audience_id')]
    public ?string $audienceID;

    /**
     * ISO-8601 timestamp of when the digest was configured.
     */
    #[Optional]
    public ?string $created;

    /**
     * Whether the digest is delivered even when nothing was collected.
     */
    #[Optional('trigger_empty')]
    public ?bool $triggerEmpty;

    /**
     * ISO-8601 timestamp of the last update.
     */
    #[Optional]
    public ?string $updated;

    /**
     * `new TopicDigestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDigestResponse::with(categories: ..., schedules: ..., templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDigestResponse)
     *   ->withCategories(...)
     *   ->withSchedules(...)
     *   ->withTemplateID(...)
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
     * @param list<TopicDigestCategory|TopicDigestCategoryShape> $categories
     * @param list<TopicDigestScheduleResponse|TopicDigestScheduleResponseShape> $schedules
     */
    public static function with(
        array $categories,
        array $schedules,
        string $templateID,
        ?string $audienceID = null,
        ?string $created = null,
        ?bool $triggerEmpty = null,
        ?string $updated = null,
    ): self {
        $self = new self;

        $self['categories'] = $categories;
        $self['schedules'] = $schedules;
        $self['templateID'] = $templateID;

        null !== $audienceID && $self['audienceID'] = $audienceID;
        null !== $created && $self['created'] = $created;
        null !== $triggerEmpty && $self['triggerEmpty'] = $triggerEmpty;
        null !== $updated && $self['updated'] = $updated;

        return $self;
    }

    /**
     * Retention rules per category key.
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
     * The digest's delivery cadences, each with its server-assigned `schedule_id`.
     *
     * @param list<TopicDigestScheduleResponse|TopicDigestScheduleResponseShape> $schedules
     */
    public function withSchedules(array $schedules): self
    {
        $self = clone $this;
        $self['schedules'] = $schedules;

        return $self;
    }

    /**
     * The notification template that renders the digest.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * The audience the digest is scoped to, when set.
     */
    public function withAudienceID(string $audienceID): self
    {
        $self = clone $this;
        $self['audienceID'] = $audienceID;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the digest was configured.
     */
    public function withCreated(string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Whether the digest is delivered even when nothing was collected.
     */
    public function withTriggerEmpty(bool $triggerEmpty): self
    {
        $self = clone $this;
        $self['triggerEmpty'] = $triggerEmpty;

        return $self;
    }

    /**
     * ISO-8601 timestamp of the last update.
     */
    public function withUpdated(string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }
}
