<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TopicPreferenceShape from \Courier\Users\Preferences\TopicPreference
 *
 * @phpstan-type PreferenceGetTopicResponseShape = array{
 *   topic: TopicPreference|TopicPreferenceShape
 * }
 */
final class PreferenceGetTopicResponse implements BaseModel
{
    /** @use SdkModel<PreferenceGetTopicResponseShape> */
    use SdkModel;

    #[Required]
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
     *
     * @param TopicPreference|TopicPreferenceShape $topic
     */
    public static function with(TopicPreference|array $topic): self
    {
        $self = new self;

        $self['topic'] = $topic;

        return $self;
    }

    /**
     * @param TopicPreference|TopicPreferenceShape $topic
     */
    public function withTopic(TopicPreference|array $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }
}
