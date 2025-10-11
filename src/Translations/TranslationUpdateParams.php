<?php

declare(strict_types=1);

namespace Courier\Translations;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new TranslationUpdateParams); // set properties as needed
 * $client->translations->update(...$params->toArray());
 * ```
 * Update a translation.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->translations->update(...$params->toArray());`
 *
 * @see Courier\Translations->update
 *
 * @phpstan-type translation_update_params = array{domain: string, body: string}
 */
final class TranslationUpdateParams implements BaseModel
{
    /** @use SdkModel<translation_update_params> */
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

        $obj->domain = $domain;
        $obj->body = $body;

        return $obj;
    }

    public function withDomain(string $domain): self
    {
        $obj = clone $this;
        $obj->domain = $domain;

        return $obj;
    }

    public function withBody(string $body): self
    {
        $obj = clone $this;
        $obj->body = $body;

        return $obj;
    }
}
