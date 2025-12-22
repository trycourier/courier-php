<?php

declare(strict_types=1);

namespace Courier\Translations;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Update a translation.
 *
 * @see Courier\Services\TranslationsService::update()
 *
 * @phpstan-type TranslationUpdateParamsShape = array{domain: string, body: string}
 */
final class TranslationUpdateParams implements BaseModel
{
    /** @use SdkModel<TranslationUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $domain;

    #[Required]
    public string $body;

    /**
     * `new TranslationUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranslationUpdateParams::with(domain: ..., body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranslationUpdateParams)->withDomain(...)->withBody(...)
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
    public static function with(string $domain, string $body): self
    {
        $self = new self;

        $self['domain'] = $domain;
        $self['body'] = $body;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    public function withBody(string $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }
}
