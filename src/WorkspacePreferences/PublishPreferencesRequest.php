<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Optional page metadata to apply when publishing the workspace's preferences page. All fields are optional; omitted fields fall back to the page defaults (and the workspace default brand).
 *
 * @phpstan-type PublishPreferencesRequestShape = array{
 *   brandID?: string|null, description?: string|null, heading?: string|null
 * }
 */
final class PublishPreferencesRequest implements BaseModel
{
    /** @use SdkModel<PublishPreferencesRequestShape> */
    use SdkModel;

    /**
     * Brand for the hosted page - "default" (workspace default brand), "none" (no brand), or a specific brand id. Defaults to "default".
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Description shown under the heading on the hosted preferences page.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Heading shown at the top of the hosted preferences page.
     */
    #[Optional(nullable: true)]
    public ?string $heading;

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
        ?string $brandID = null,
        ?string $description = null,
        ?string $heading = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $heading && $self['heading'] = $heading;

        return $self;
    }

    /**
     * Brand for the hosted page - "default" (workspace default brand), "none" (no brand), or a specific brand id. Defaults to "default".
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Description shown under the heading on the hosted preferences page.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Heading shown at the top of the hosted preferences page.
     */
    public function withHeading(?string $heading): self
    {
        $self = clone $this;
        $self['heading'] = $heading;

        return $self;
    }
}
