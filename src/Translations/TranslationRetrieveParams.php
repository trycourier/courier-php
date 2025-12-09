<?php

declare(strict_types=1);

namespace Courier\Translations;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get translations by locale.
 *
 * @see Courier\Services\TranslationsService::retrieve()
 *
 * @phpstan-type TranslationRetrieveParamsShape = array{domain: string}
 */
final class TranslationRetrieveParams implements BaseModel
{
    /** @use SdkModel<TranslationRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $domain;

    /**
     * `new TranslationRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranslationRetrieveParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranslationRetrieveParams)->withDomain(...)
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
    public static function with(string $domain): self
    {
        $self = new self;

        $self['domain'] = $domain;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }
}
