<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic;

/**
 * Adds or updates a user's preferences for several subscription topics at once. Topics you leave out keep whatever they were set to before.
 *
 * @see Courier\Services\Users\PreferencesService::bulkUpdate()
 *
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic
 *
 * @phpstan-type PreferenceBulkUpdateParamsShape = array{
 *   topics: list<Topic|TopicShape>,
 *   tenantID?: string|null,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
 * }
 */
final class PreferenceBulkUpdateParams implements BaseModel
{
    /** @use SdkModel<PreferenceBulkUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The topics to create or update. Between 1 and 50 topics may be provided in a single request.
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

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

    /**
     * `new PreferenceBulkUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceBulkUpdateParams::with(topics: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceBulkUpdateParams)->withTopics(...)
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
    public static function with(
        array $topics,
        ?string $tenantID = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
    ): self {
        $self = new self;

        $self['topics'] = $topics;

        null !== $tenantID && $self['tenantID'] = $tenantID;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }

    /**
     * The topics to create or update. Between 1 and 50 topics may be provided in a single request.
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

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withXIdempotencyExpiration(
        string $xIdempotencyExpiration
    ): self {
        $self = clone $this;
        $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }
}
