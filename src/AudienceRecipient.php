<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send to all users in an audience.
 *
 * @phpstan-import-type AudienceFilterShape from \Courier\AudienceFilter
 *
 * @phpstan-type AudienceRecipientShape = array{
 *   audienceID: string,
 *   data?: array<string,mixed>|null,
 *   filters?: list<AudienceFilterShape>|null,
 * }
 */
final class AudienceRecipient implements BaseModel
{
    /** @use SdkModel<AudienceRecipientShape> */
    use SdkModel;

    /**
     * A unique identifier associated with an Audience. A message will be sent to each user in the audience.
     */
    #[Required('audience_id')]
    public string $audienceID;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /** @var list<AudienceFilter>|null $filters */
    #[Optional(list: AudienceFilter::class, nullable: true)]
    public ?array $filters;

    /**
     * `new AudienceRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceRecipient::with(audienceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceRecipient)->withAudienceID(...)
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
     * @param array<string,mixed>|null $data
     * @param list<AudienceFilterShape>|null $filters
     */
    public static function with(
        string $audienceID,
        ?array $data = null,
        ?array $filters = null
    ): self {
        $self = new self;

        $self['audienceID'] = $audienceID;

        null !== $data && $self['data'] = $data;
        null !== $filters && $self['filters'] = $filters;

        return $self;
    }

    /**
     * A unique identifier associated with an Audience. A message will be sent to each user in the audience.
     */
    public function withAudienceID(string $audienceID): self
    {
        $self = clone $this;
        $self['audienceID'] = $audienceID;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<AudienceFilterShape>|null $filters
     */
    public function withFilters(?array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }
}
