<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class BrandSettingsSocialPresence extends JsonSerializableType
{
    /**
     * @var ?bool $inheritDefault
     */
    #[JsonProperty('inheritDefault')]
    public ?bool $inheritDefault;

    /**
     * @var ?BaseSocialPresence $facebook
     */
    #[JsonProperty('facebook')]
    public ?BaseSocialPresence $facebook;

    /**
     * @var ?BaseSocialPresence $instagram
     */
    #[JsonProperty('instagram')]
    public ?BaseSocialPresence $instagram;

    /**
     * @var ?BaseSocialPresence $linkedin
     */
    #[JsonProperty('linkedin')]
    public ?BaseSocialPresence $linkedin;

    /**
     * @var ?BaseSocialPresence $medium
     */
    #[JsonProperty('medium')]
    public ?BaseSocialPresence $medium;

    /**
     * @var ?BaseSocialPresence $twitter
     */
    #[JsonProperty('twitter')]
    public ?BaseSocialPresence $twitter;

    /**
     * @param array{
     *   inheritDefault?: ?bool,
     *   facebook?: ?BaseSocialPresence,
     *   instagram?: ?BaseSocialPresence,
     *   linkedin?: ?BaseSocialPresence,
     *   medium?: ?BaseSocialPresence,
     *   twitter?: ?BaseSocialPresence,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->inheritDefault = $values['inheritDefault'] ?? null;
        $this->facebook = $values['facebook'] ?? null;
        $this->instagram = $values['instagram'] ?? null;
        $this->linkedin = $values['linkedin'] ?? null;
        $this->medium = $values['medium'] ?? null;
        $this->twitter = $values['twitter'] ?? null;
    }
}
