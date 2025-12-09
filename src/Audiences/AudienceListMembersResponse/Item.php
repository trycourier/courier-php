<?php

declare(strict_types=1);

namespace Courier\Audiences\AudienceListMembersResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   addedAt: string,
 *   audienceID: string,
 *   audienceVersion: int,
 *   memberID: string,
 *   reason: string,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Required('added_at')]
    public string $addedAt;

    #[Required('audience_id')]
    public string $audienceID;

    #[Required('audience_version')]
    public int $audienceVersion;

    #[Required('member_id')]
    public string $memberID;

    #[Required]
    public string $reason;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   addedAt: ...,
     *   audienceID: ...,
     *   audienceVersion: ...,
     *   memberID: ...,
     *   reason: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withAddedAt(...)
     *   ->withAudienceID(...)
     *   ->withAudienceVersion(...)
     *   ->withMemberID(...)
     *   ->withReason(...)
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
     */
    public static function with(
        string $addedAt,
        string $audienceID,
        int $audienceVersion,
        string $memberID,
        string $reason,
    ): self {
        $self = new self;

        $self['addedAt'] = $addedAt;
        $self['audienceID'] = $audienceID;
        $self['audienceVersion'] = $audienceVersion;
        $self['memberID'] = $memberID;
        $self['reason'] = $reason;

        return $self;
    }

    public function withAddedAt(string $addedAt): self
    {
        $self = clone $this;
        $self['addedAt'] = $addedAt;

        return $self;
    }

    public function withAudienceID(string $audienceID): self
    {
        $self = clone $this;
        $self['audienceID'] = $audienceID;

        return $self;
    }

    public function withAudienceVersion(int $audienceVersion): self
    {
        $self = clone $this;
        $self['audienceVersion'] = $audienceVersion;

        return $self;
    }

    public function withMemberID(string $memberID): self
    {
        $self = clone $this;
        $self['memberID'] = $memberID;

        return $self;
    }

    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
