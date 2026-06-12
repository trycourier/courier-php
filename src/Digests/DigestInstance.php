<?php

declare(strict_types=1);

namespace Courier\Digests;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Digests\DigestInstance\Status;

/**
 * @phpstan-import-type DigestCategoryShape from \Courier\Digests\DigestCategory
 *
 * @phpstan-type DigestInstanceShape = array{
 *   digestInstanceID: string,
 *   eventCount: int,
 *   status: Status|value-of<Status>,
 *   userID: string,
 *   categories?: list<DigestCategory|DigestCategoryShape>|null,
 *   categoryKeyCounts?: array<string,int>|null,
 *   createdAt?: string|null,
 *   disabled?: bool|null,
 *   tenantID?: string|null,
 * }
 */
final class DigestInstance implements BaseModel
{
    /** @use SdkModel<DigestInstanceShape> */
    use SdkModel;

    /**
     * A unique identifier for the digest instance.
     */
    #[Required('digest_instance_id')]
    public string $digestInstanceID;

    /**
     * The total number of events received for this instance.
     */
    #[Required('event_count')]
    public int $eventCount;

    /**
     * The status of the digest instance. `IN_PROGRESS` instances are still accumulating events; `COMPLETED` instances have been released.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The ID of the user this digest instance belongs to.
     */
    #[Required('user_id')]
    public string $userID;

    /**
     * The categories configured for the digest.
     *
     * @var list<DigestCategory>|null $categories
     */
    #[Optional(list: DigestCategory::class)]
    public ?array $categories;

    /**
     * A map of category key to the number of events received for that category.
     *
     * @var array<string,int>|null $categoryKeyCounts
     */
    #[Optional('category_key_counts', map: 'int')]
    public ?array $categoryKeyCounts;

    /**
     * An ISO 8601 timestamp of when the digest instance was created.
     */
    #[Optional('created_at')]
    public ?string $createdAt;

    /**
     * Whether the digest instance has been disabled.
     */
    #[Optional]
    public ?bool $disabled;

    /**
     * The ID of the tenant this digest instance belongs to, if any.
     */
    #[Optional('tenant_id', nullable: true)]
    public ?string $tenantID;

    /**
     * `new DigestInstance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigestInstance::with(
     *   digestInstanceID: ..., eventCount: ..., status: ..., userID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigestInstance)
     *   ->withDigestInstanceID(...)
     *   ->withEventCount(...)
     *   ->withStatus(...)
     *   ->withUserID(...)
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
     * @param Status|value-of<Status> $status
     * @param list<DigestCategory|DigestCategoryShape>|null $categories
     * @param array<string,int>|null $categoryKeyCounts
     */
    public static function with(
        string $digestInstanceID,
        int $eventCount,
        Status|string $status,
        string $userID,
        ?array $categories = null,
        ?array $categoryKeyCounts = null,
        ?string $createdAt = null,
        ?bool $disabled = null,
        ?string $tenantID = null,
    ): self {
        $self = new self;

        $self['digestInstanceID'] = $digestInstanceID;
        $self['eventCount'] = $eventCount;
        $self['status'] = $status;
        $self['userID'] = $userID;

        null !== $categories && $self['categories'] = $categories;
        null !== $categoryKeyCounts && $self['categoryKeyCounts'] = $categoryKeyCounts;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $disabled && $self['disabled'] = $disabled;
        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * A unique identifier for the digest instance.
     */
    public function withDigestInstanceID(string $digestInstanceID): self
    {
        $self = clone $this;
        $self['digestInstanceID'] = $digestInstanceID;

        return $self;
    }

    /**
     * The total number of events received for this instance.
     */
    public function withEventCount(int $eventCount): self
    {
        $self = clone $this;
        $self['eventCount'] = $eventCount;

        return $self;
    }

    /**
     * The status of the digest instance. `IN_PROGRESS` instances are still accumulating events; `COMPLETED` instances have been released.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The ID of the user this digest instance belongs to.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * The categories configured for the digest.
     *
     * @param list<DigestCategory|DigestCategoryShape> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * A map of category key to the number of events received for that category.
     *
     * @param array<string,int> $categoryKeyCounts
     */
    public function withCategoryKeyCounts(array $categoryKeyCounts): self
    {
        $self = clone $this;
        $self['categoryKeyCounts'] = $categoryKeyCounts;

        return $self;
    }

    /**
     * An ISO 8601 timestamp of when the digest instance was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Whether the digest instance has been disabled.
     */
    public function withDisabled(bool $disabled): self
    {
        $self = clone $this;
        $self['disabled'] = $disabled;

        return $self;
    }

    /**
     * The ID of the tenant this digest instance belongs to, if any.
     */
    public function withTenantID(?string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
