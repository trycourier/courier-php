<?php

declare(strict_types=1);

namespace Courier\Audiences\AudienceListMembersResponse;

use Courier\Core\Attributes\Api;
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

    #[Api('added_at')]
    public string $addedAt;

    #[Api('audience_id')]
    public string $audienceID;

    #[Api('audience_version')]
    public int $audienceVersion;

    #[Api('member_id')]
    public string $memberID;

    #[Api]
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
        $obj = new self;

        $obj->addedAt = $addedAt;
        $obj->audienceID = $audienceID;
        $obj->audienceVersion = $audienceVersion;
        $obj->memberID = $memberID;
        $obj->reason = $reason;

        return $obj;
    }

    public function withAddedAt(string $addedAt): self
    {
        $obj = clone $this;
        $obj->addedAt = $addedAt;

        return $obj;
    }

    public function withAudienceID(string $audienceID): self
    {
        $obj = clone $this;
        $obj->audienceID = $audienceID;

        return $obj;
    }

    public function withAudienceVersion(int $audienceVersion): self
    {
        $obj = clone $this;
        $obj->audienceVersion = $audienceVersion;

        return $obj;
    }

    public function withMemberID(string $memberID): self
    {
        $obj = clone $this;
        $obj->memberID = $memberID;

        return $obj;
    }

    public function withReason(string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }
}
