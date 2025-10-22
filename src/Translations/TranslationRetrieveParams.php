<?php

declare(strict_types=1);

namespace Courier\Translations;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get translations by locale.
 *
 * @see Courier\Translations->retrieve
 *
 * @phpstan-type translation_retrieve_params = array{domain: string}
 */
final class TranslationRetrieveParams implements BaseModel
{
    /** @use SdkModel<translation_retrieve_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
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
        $obj = new self;

        $obj->domain = $domain;

        return $obj;
    }

    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj->domain = $domain;

        return $obj;
    }
}
