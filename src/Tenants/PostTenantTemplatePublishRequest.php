<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for publishing a tenant template version.
 *
 * @phpstan-type PostTenantTemplatePublishRequestShape = array{
 *   version?: string|null
 * }
 */
final class PostTenantTemplatePublishRequest implements BaseModel
{
    /** @use SdkModel<PostTenantTemplatePublishRequestShape> */
    use SdkModel;

    /**
     * The version of the template to publish (e.g., "v1", "v2", "latest"). If not provided, defaults to "latest".
     */
    #[Optional]
    public ?string $version;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $version = null): self
    {
        $self = new self;

        null !== $version && $self['version'] = $version;

        return $self;
    }

    /**
     * The version of the template to publish (e.g., "v1", "v2", "latest"). If not provided, defaults to "latest".
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
