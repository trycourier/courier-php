<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get the audiences associated with the authorization token.
 *
 * @see Courier\Services\AudiencesService::list()
 *
 * @phpstan-type AudienceListParamsShape = array{cursor?: string|null}
 */
final class AudienceListParams implements BaseModel
{
    /** @use SdkModel<AudienceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of audiences.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null): self
    {
        $obj = new self;

        null !== $cursor && $obj['cursor'] = $cursor;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of audiences.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj['cursor'] = $cursor;

        return $obj;
    }
}
