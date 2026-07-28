<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Publishes the workspace preference page, snapshotting every preference and topic, and returns the page id and a preview URL.
 *
 * @see Courier\Services\WorkspacePreferencesService::publish()
 *
 * @phpstan-type WorkspacePreferencePublishParamsShape = array{
 *   brandID?: string|null,
 *   description?: string|null,
 *   heading?: string|null,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
 * }
 */
final class WorkspacePreferencePublishParams implements BaseModel
{
    /** @use SdkModel<WorkspacePreferencePublishParamsShape> */
    use SdkModel;
    use SdkParams;

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

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

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
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $heading && $self['heading'] = $heading;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

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
