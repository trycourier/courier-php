<?php

declare(strict_types=1);

namespace Courier\Journeys\Templates;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch a journey-scoped notification template by id. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` for a historical version.
 *
 * @see Courier\Services\Journeys\TemplatesService::retrieve()
 *
 * @phpstan-type TemplateRetrieveParamsShape = array{templateID: string}
 */
final class TemplateRetrieveParams implements BaseModel
{
    /** @use SdkModel<TemplateRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $templateID;

    /**
     * `new TemplateRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateRetrieveParams::with(templateID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateRetrieveParams)->withTemplateID(...)
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
