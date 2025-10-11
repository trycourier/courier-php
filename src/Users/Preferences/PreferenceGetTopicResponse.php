<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\TopicPreference;

/**
 * @phpstan-type preference_get_topic_response = array{topic: TopicPreference}
 */
final class PreferenceGetTopicResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<preference_get_topic_response> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public TopicPreference $topic;

    /**
     * `new PreferenceGetTopicResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceGetTopicResponse::with(topic: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceGetTopicResponse)->withTopic(...)
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
    public static function with(TopicPreference $topic): self
    {
        $obj = new self;

        $obj->topic = $topic;

        return $obj;
    }

    public function withTopic(TopicPreference $topic): self
    {
        $obj = clone $this;
        $obj->topic = $topic;

        return $obj;
    }
}
