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
 * Replaces a user's entire set of preference overrides. Any topic you leave out is reset to its default, so send the full set rather than a subset.
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
     * Replace the preferences of a user for this specific tenant context.
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
     * Replace the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
