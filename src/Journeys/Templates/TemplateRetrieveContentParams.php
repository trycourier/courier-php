<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve the elemental content of a journey-scoped notification template. The response contains the versioned elements with their content checksums. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` for a historical version.
 *
 * @see Courier\Services\Journeys\TemplatesService::retrieveContent()
 *
 * @phpstan-type TemplateRetrieveContentParamsShape = array{
 *   templateID: string, version?: string|null
 * }
 */
final class TemplateRetrieveContentParams implements BaseModel
{
    /** @use SdkModel<TemplateRetrieveContentParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    /**
     * Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
     */
    #[Optional]
    public ?string $version;

    /**
     * `new TemplateRetrieveContentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateRetrieveContentParams::with(templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateRetrieveContentParams)->withTemplateID(...)
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
        string $templateID,
        ?string $version = null
    ): self {
        $self = new self;

        $self['templateID'] = $templateID;

        null !== $version && $self['version'] = $version;

        return $self;
    }

    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * Accepts `draft`, `published`, or a version string (e.g., `v001`). Defaults to `published`.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
