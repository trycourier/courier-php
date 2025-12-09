<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AudienceUpdateResponseShape = array{audience: Audience}
 */
final class AudienceUpdateResponse implements BaseModel
{
    /** @use SdkModel<AudienceUpdateResponseShape> */
    use SdkModel;

    #[Required]
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
     *
     * @param Audience|array{
     *   id: string,
     *   createdAt: string,
     *   description: string,
     *   filter: Filter,
     *   name: string,
     *   updatedAt: string,
     * } $audience
     */
    public static function with(Audience|array $audience): self
    {
        $obj = new self;

        $obj['audience'] = $audience;

        return $obj;
    }

    /**
     * @param Audience|array{
     *   id: string,
     *   createdAt: string,
     *   description: string,
     *   filter: Filter,
     *   name: string,
     *   updatedAt: string,
     * } $audience
     */
    public function withAudience(Audience|array $audience): self
    {
        $obj = clone $this;
        $obj['audience'] = $audience;

        return $obj;
    }
}
