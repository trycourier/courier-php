<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Archive a journey-scoped notification template. Archived templates cannot be sent.
 *
 * @see Courier\Services\Journeys\TemplatesService::archive()
 *
 * @phpstan-type TemplateArchiveParamsShape = array{templateID: string}
 */
final class TemplateArchiveParams implements BaseModel
{
    /** @use SdkModel<TemplateArchiveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    /**
     * `new TemplateArchiveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateArchiveParams::with(templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateArchiveParams)->withTemplateID(...)
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
    public static function with(string $templateID): self
    {
        $self = new self;

        $self['templateID'] = $templateID;

        return $self;
    }

    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }
}
