<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Automations\AutomationListParams\Version;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get the list of automations.
 *
 * @see Courier\Services\AutomationsService::list()
 *
 * @phpstan-type AutomationListParamsShape = array{
 *   cursor?: string|null, version?: null|Version|value-of<Version>
 * }
 */
final class AutomationListParams implements BaseModel
{
    /** @use SdkModel<AutomationListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A cursor token for pagination. Use the cursor from the previous response to fetch the next page of results.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * The version of templates to retrieve. Accepted values are published (for published templates) or draft (for draft templates). Defaults to published.
     *
     * @var value-of<Version>|null $version
     */
    #[Optional(enum: Version::class)]
    public ?string $version;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Version|value-of<Version>|null $version
     */
    public static function with(
        ?string $cursor = null,
        Version|string|null $version = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $version && $self['version'] = $version;

        return $self;
    }

    /**
     * A cursor token for pagination. Use the cursor from the previous response to fetch the next page of results.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The version of templates to retrieve. Accepted values are published (for published templates) or draft (for draft templates). Defaults to published.
     *
     * @param Version|value-of<Version> $version
     */
    public function withVersion(Version|string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
