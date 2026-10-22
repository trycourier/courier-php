<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyRunStep;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Why the step failed. Set when `status` is `ERROR`, `null` otherwise.
 *
 * @phpstan-type ErrorShape = array{message: string}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * The reason, e.g. `Fetch failed: GET api.example.com returned 404` or `AI step timed out after 15 minutes`.
     */
    #[Required]
    public string $message;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withMessage(...)
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
    public static function with(string $message): self
    {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * The reason, e.g. `Fetch failed: GET api.example.com returned 404` or `AI step timed out after 15 minutes`.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
