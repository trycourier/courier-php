<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\WorkspacePreferenceTopicCreateRequest;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\WorkspacePreferences\TopicDigestCategory;
use Courier\WorkspacePreferences\TopicDigestScheduleRequest;

/**
 * A topic's digest, as supplied when the topic itself is created: the template that renders it, the cadences it delivers on, and how collected events are retained.
 *
 * Identical to `TopicDigestRequest`, which a replace uses, except that `schedules` is required — a topic being created has no stored schedules for an absent key to leave alone.
 *
 * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected, because both states are un-deliverable rather than merely off.
 *
 * @phpstan-import-type TopicDigestScheduleRequestShape from \Courier\WorkspacePreferences\TopicDigestScheduleRequest
 * @phpstan-import-type TopicDigestCategoryShape from \Courier\WorkspacePreferences\TopicDigestCategory
 *
 * @phpstan-type DigestShape = array{
 *   schedules: list<TopicDigestScheduleRequest|TopicDigestScheduleRequestShape>,
 *   templateID: string,
 *   audienceID?: string|null,
 *   categories?: list<TopicDigestCategory|TopicDigestCategoryShape>|null,
 *   triggerEmpty?: bool|null,
 * }
 */
final class Digest implements BaseModel
{
    /** @use SdkModel<DigestShape> */
    use SdkModel;

    /**
     * The cadences this digest delivers on.
     *
     * The array replaces the stored schedules wholesale, so a schedule you leave out of it is deleted along with its delivery rule. Omit the key entirely to leave the stored schedules untouched — useful for changing `template_id` or `categories` without restating every schedule.
     *
     * A digest must end up with at least one schedule, because one with none collects events into an instance that can never fire. So sending `[]` is always a `400`, and so is omitting the key on a topic that has no schedules stored yet.
     *
     * On **create** the key is required outright: a topic being created has nothing stored to leave alone, and the topic row is written before its digest, so rejecting it any later would leave the topic behind and let a retry duplicate it.
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
     * `new Digest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Digest::with(schedules: ..., templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Digest)->withSchedules(...)->withTemplateID(...)
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
     * The cadences this digest delivers on.
     *
     * The array replaces the stored schedules wholesale, so a schedule you leave out of it is deleted along with its delivery rule. Omit the key entirely to leave the stored schedules untouched — useful for changing `template_id` or `categories` without restating every schedule.
     *
     * A digest must end up with at least one schedule, because one with none collects events into an instance that can never fire. So sending `[]` is always a `400`, and so is omitting the key on a topic that has no schedules stored yet.
     *
     * On **create** the key is required outright: a topic being created has nothing stored to leave alone, and the topic row is written before its digest, so rejecting it any later would leave the topic behind and let a retry duplicate it.
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
