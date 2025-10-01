<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type audience_update_response = array{audience: Audience}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class AudienceUpdateResponse implements BaseModel
{
    /** @use SdkModel<audience_update_response> */
    use SdkModel;

    #[Api]
    public Audience $audience;

    /**
     * `new AudienceUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceUpdateResponse::with(audience: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceUpdateResponse)->withAudience(...)
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
    public static function with(Audience $audience): self
    {
        $obj = new self;

        $obj->audience = $audience;

        return $obj;
    }

    public function withAudience(Audience $audience): self
    {
        $obj = clone $this;
        $obj->audience = $audience;

        return $obj;
    }
}
