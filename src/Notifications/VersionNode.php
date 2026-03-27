<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A version entry for a notification template.
 *
 * @phpstan-type VersionNodeShape = array{
 *   created: int, creator: string, version: string, hasChanges?: bool|null
 * }
 */
final class VersionNode implements BaseModel
{
    /** @use SdkModel<VersionNodeShape> */
    use SdkModel;

    /**
     * Epoch milliseconds when this version was created.
     */
    #[Required]
    public int $created;

    /**
     * User ID of the version creator.
     */
    #[Required]
    public string $creator;

    /**
     * Version identifier. One of "draft", "published:vNNN" (current published version), or "vNNN" (historical version).
     */
    #[Required]
    public string $version;

    /**
     * Whether the draft has unpublished changes. Only present on the draft version.
     */
    #[Optional('has_changes')]
    public ?bool $hasChanges;

    /**
     * `new VersionNode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VersionNode::with(created: ..., creator: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VersionNode)->withCreated(...)->withCreator(...)->withVersion(...)
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
        int $created,
        string $creator,
        string $version,
        ?bool $hasChanges = null
    ): self {
        $self = new self;

        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['version'] = $version;

        null !== $hasChanges && $self['hasChanges'] = $hasChanges;

        return $self;
    }

    /**
     * Epoch milliseconds when this version was created.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * User ID of the version creator.
     */
    public function withCreator(string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    /**
     * Version identifier. One of "draft", "published:vNNN" (current published version), or "vNNN" (historical version).
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    /**
     * Whether the draft has unpublished changes. Only present on the draft version.
     */
    public function withHasChanges(bool $hasChanges): self
    {
        $self = clone $this;
        $self['hasChanges'] = $hasChanges;

        return $self;
    }
}
