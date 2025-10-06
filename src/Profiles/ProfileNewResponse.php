<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Profiles\ProfileNewResponse\Status;

/**
 * @phpstan-type profile_new_response = array{status: value-of<Status>}
 */
final class ProfileNewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<profile_new_response> */
    use SdkModel;

    use SdkResponse;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * `new ProfileNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileNewResponse::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileNewResponse)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status): self
    {
        $obj = new self;

        $obj['status'] = $status;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
