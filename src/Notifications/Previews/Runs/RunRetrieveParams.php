<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve one of this template's preview runs together with its per-device results.
 *
 * A run is only readable under the template it previewed: under any other template it is a 404, the same as a run that does not exist.
 *
 * `thumbnail_url` and `screenshot_url` are short-lived signed URLs, re-signed on every read. Fetch them now rather than storing them. Both are null until Courier's own copy of the image exists, which is what `status: COMPLETED` on a result means.
 *
 * @see Courier\Services\Notifications\Previews\RunsService::retrieve()
 *
 * @phpstan-type RunRetrieveParamsShape = array{id: string}
 */
final class RunRetrieveParams implements BaseModel
{
    /** @use SdkModel<RunRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new RunRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RunRetrieveParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RunRetrieveParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
