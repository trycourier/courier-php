<?php

namespace Courier\Automations\Traits;

use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

/**
 * @property ?string $brand
 * @property ?array<string, mixed> $data
 * @property mixed $profile
 * @property ?string $recipient
 * @property ?string $template
 */
trait AutomationInvokeParams
{
    /**
     * @var ?string $brand
     */
    #[JsonProperty('brand')]
    public ?string $brand;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    public ?array $data;

    /**
     * @var mixed $profile
     */
    #[JsonProperty('profile')]
    public mixed $profile;

    /**
     * @var ?string $recipient
     */
    #[JsonProperty('recipient')]
    public ?string $recipient;

    /**
     * @var ?string $template
     */
    #[JsonProperty('template')]
    public ?string $template;
}
