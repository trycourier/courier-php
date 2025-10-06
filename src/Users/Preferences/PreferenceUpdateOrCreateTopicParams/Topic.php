<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\Users\Preferences\PreferenceStatus;

/**
 * @phpstan-type topic_alias = array{
 *   status: value-of<PreferenceStatus>,
 *   customRouting?: list<value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class Topic implements BaseModel
{
    /** @use SdkModel<topic_alias> */
    use SdkModel;

    /** @var value-of<PreferenceStatus> $status */
    #[Api(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * The Channels a user has chosen to receive notifications through for this topic.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Api(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true,
        optional: true,
    )]
    public ?array $customRouting;

    #[Api('has_custom_routing', nullable: true, optional: true)]
    public ?bool $hasCustomRouting;

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
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        PreferenceStatus|string $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $customRouting && $obj['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $obj->hasCustomRouting = $hasCustomRouting;

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
        $obj['customRouting'] = $customRouting;

        return $obj;
    }

    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }
}
