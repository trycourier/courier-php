<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List published versions of the journey-scoped notification template, ordered most recent first.
 *
 * @see Courier\Services\Journeys\TemplatesService::listVersions()
 *
 * @phpstan-type TemplateListVersionsParamsShape = array{templateID: string}
 */
final class TemplateListVersionsParams implements BaseModel
{
    /** @use SdkModel<TemplateListVersionsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    /**
     * `new TemplateListVersionsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateListVersionsParams::with(templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateListVersionsParams)->withTemplateID(...)
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
