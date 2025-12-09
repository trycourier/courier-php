<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type PreferenceGetTopicResponseShape = array{topic: TopicPreference}
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
     * @param TopicPreference|array{
     *   defaultStatus: value-of<PreferenceStatus>,
     *   status: value-of<PreferenceStatus>,
     *   topicID: string,
     *   topicName: string,
     *   customRouting?: list<value-of<ChannelClassification>>|null,
     *   hasCustomRouting?: bool|null,
     * } $topic
     */
    public static function with(TopicPreference|array $topic): self
    {
        $obj = new self;

        $obj['topic'] = $topic;

        return $obj;
    }

    /**
     * @param TopicPreference|array{
     *   defaultStatus: value-of<PreferenceStatus>,
     *   status: value-of<PreferenceStatus>,
     *   topicID: string,
     *   topicName: string,
     *   customRouting?: list<value-of<ChannelClassification>>|null,
     *   hasCustomRouting?: bool|null,
     * } $topic
     */
    public function withTopic(TopicPreference|array $topic): self
    {
        $obj = clone $this;
        $obj['topic'] = $topic;

        return $obj;
    }
}
