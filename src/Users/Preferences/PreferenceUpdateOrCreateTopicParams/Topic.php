<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type TopicShape = array{
 *   status: value-of<PreferenceStatus>,
 *   custom_routing?: list<value-of<ChannelClassification>>|null,
 *   has_custom_routing?: bool|null,
 * }
 */
final class Topic implements BaseModel
{
    /** @use SdkModel<TopicShape> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $custom_routing
     */
    #[Api(list: ChannelClassification::class, nullable: true, optional: true)]
    public ?array $custom_routing;

    #[Api(nullable: true, optional: true)]
    public ?bool $has_custom_routing;

    /**
     * `new Topic()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Topic::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Topic)->withStatus(...)
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
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $custom_routing
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $custom_routing = null,
        ?bool $has_custom_routing = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $custom_routing && $obj['custom_routing'] = $custom_routing;
        null !== $has_custom_routing && $obj->has_custom_routing = $has_custom_routing;

        return $obj;
    }

    /**
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $obj = clone $this;
        $obj['custom_routing'] = $customRouting;

        return $obj;
    }

    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj->has_custom_routing = $hasCustomRouting;

        return $obj;
    }
}
