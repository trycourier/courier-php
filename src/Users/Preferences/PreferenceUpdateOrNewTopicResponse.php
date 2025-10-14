<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type preference_update_or_new_topic_response = array{message: string}
 */
final class PreferenceUpdateOrNewTopicResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<preference_update_or_new_topic_response> */
    use SdkModel;

    use SdkResponse;

    #[Api]
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

        $obj->message = $message;

        return $obj;
    }

    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
