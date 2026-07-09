<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic;

/**
 * Replace a user's complete set of preference overrides in a single request. The topics in the request body become the recipient's entire set of overrides: listed topics are created or updated, and every existing override that is not included in the body is reset to its topic default. Submitting an empty `topics` array is a valid clear-all that resets every existing override.
 *
 * This operation is validation-atomic (all-or-nothing): structural validation fails fast with a single `400`, and if any topic is semantically invalid (an unknown topic, a `REQUIRED` topic that cannot be opted out, or a custom routing request that is not available on the workspace's plan) the request returns a single `400` aggregating every failure in `errors` and writes nothing. On success it returns `200` with `items` (the complete resulting override set) and `deleted` (the ids of the overrides that were reset to default).
 *
 * Every `topic_id` in the response — in `items`, `deleted`, and any `errors` — is returned in Courier's canonical topic id form, regardless of the form supplied in the request.
 *
 * @see Courier\Services\Users\PreferencesService::bulkReplace()
 *
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic
 *
 * @phpstan-type PreferenceBulkReplaceParamsShape = array{
 *   topics: list<Topic|TopicShape>, tenantID?: string|null
 * }
 */
final class PreferenceBulkReplaceParams implements BaseModel
{
    /** @use SdkModel<PreferenceBulkReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The complete set of topic overrides for the user. Up to 50 topics may be provided. Any existing override not listed here is reset to its topic default; an empty array resets every existing override.
     *
     * @var list<Topic> $topics
     */
    #[Required(list: Topic::class)]
    public array $topics;

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    #[Optional(nullable: true)]
    public ?string $tenantID;

    /**
     * `new PreferenceBulkReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceBulkReplaceParams::with(topics: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceBulkReplaceParams)->withTopics(...)
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
     * @param list<Topic|TopicShape> $topics
     */
    public static function with(array $topics, ?string $tenantID = null): self
    {
        $self = new self;

        $self['topics'] = $topics;

        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * The complete set of topic overrides for the user. Up to 50 topics may be provided. Any existing override not listed here is reset to its topic default; an empty array resets every existing override.
     *
     * @param list<Topic|TopicShape> $topics
     */
    public function withTopics(array $topics): self
    {
        $self = clone $this;
        $self['topics'] = $topics;

        return $self;
    }

    /**
     * Update the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
