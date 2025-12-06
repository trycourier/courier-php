<?php

declare(strict_types=1);

namespace Courier\Translations;

use Courier\Core\Attributes\Api;
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

    #[Api]
    public string $domain;

    #[Api]
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
        $obj = new self;

        $obj['domain'] = $domain;
        $obj['body'] = $body;

        return $obj;
    }

    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj['domain'] = $domain;

        return $obj;
    }

    public function withBody(string $body): self
    {
        $obj = clone $this;
        $obj['body'] = $body;

        return $obj;
    }
}
