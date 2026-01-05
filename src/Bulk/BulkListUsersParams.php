<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Get Bulk Job Users.
 *
 * @see Courier\Services\BulkService::listUsers()
 *
 * @phpstan-type BulkListUsersParamsShape = array{cursor?: string|null}
 */
final class BulkListUsersParams implements BaseModel
{
    /** @use SdkModel<BulkListUsersParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of users added to the bulk job.
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
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * A unique identifier that allows for fetching the next set of users added to the bulk job.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }
}
