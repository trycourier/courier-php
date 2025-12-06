<?php

declare(strict_types=1);

namespace Courier\Audiences\AudienceListMembersResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   added_at: string,
 *   audience_id: string,
 *   audience_version: int,
 *   member_id: string,
 *   reason: string,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Api]
    public string $added_at;

    #[Api]
    public string $audience_id;

    #[Api]
    public int $audience_version;

    #[Api]
    public string $member_id;

    #[Api]
    public string $reason;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   added_at: ...,
     *   audience_id: ...,
     *   audience_version: ...,
     *   member_id: ...,
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
        string $added_at,
        string $audience_id,
        int $audience_version,
        string $member_id,
        string $reason,
    ): self {
        $obj = new self;

        $obj['added_at'] = $added_at;
        $obj['audience_id'] = $audience_id;
        $obj['audience_version'] = $audience_version;
        $obj['member_id'] = $member_id;
        $obj['reason'] = $reason;

        return $obj;
    }

    public function withAddedAt(string $addedAt): self
    {
        $obj = clone $this;
        $obj['added_at'] = $addedAt;

        return $obj;
    }

    public function withAudienceID(string $audienceID): self
    {
        $obj = clone $this;
        $obj['audience_id'] = $audienceID;

        return $obj;
    }

    public function withAudienceVersion(int $audienceVersion): self
    {
        $obj = clone $this;
        $obj['audience_version'] = $audienceVersion;

        return $obj;
    }

    public function withMemberID(string $memberID): self
    {
        $obj = clone $this;
        $obj['member_id'] = $memberID;

        return $obj;
    }

    public function withReason(string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }
}
