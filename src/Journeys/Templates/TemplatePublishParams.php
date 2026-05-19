<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Publish the current draft of the journey-scoped notification template as a new version. Optionally roll back to a prior version by passing `{ "version": "vN" }`.
 *
 * @see Courier\Services\Journeys\TemplatesService::publish()
 *
 * @phpstan-type TemplatePublishParamsShape = array{
 *   templateID: string, version?: string|null
 * }
 */
final class TemplatePublishParams implements BaseModel
{
    /** @use SdkModel<TemplatePublishParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    #[Optional]
    public ?string $version;

    /**
     * `new TemplatePublishParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplatePublishParams::with(templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplatePublishParams)->withTemplateID(...)
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

    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
