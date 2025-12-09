<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type PreferenceUpdateOrNewTopicResponseShape = array{message: string}
 */
final class PreferenceUpdateOrNewTopicResponse implements BaseModel
{
    /** @use SdkModel<PreferenceUpdateOrNewTopicResponseShape> */
    use SdkModel;

    #[Required]
    public string $message;

    /**
     * `new PreferenceUpdateOrNewTopicResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceUpdateOrNewTopicResponse::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceUpdateOrNewTopicResponse)->withMessage(...)
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
        $obj = new self;

        $obj['message'] = $message;

        return $obj;
    }

    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }
}
