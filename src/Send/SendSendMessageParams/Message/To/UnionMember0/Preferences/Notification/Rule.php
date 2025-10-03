<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type rule_alias = array{until: string, start?: string|null}
 */
final class Rule implements BaseModel
{
    /** @use SdkModel<rule_alias> */
    use SdkModel;

    #[Api]
    public string $until;

    #[Api(nullable: true, optional: true)]
    public ?string $start;

    /**
     * `new Rule()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rule::with(until: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rule)->withUntil(...)
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
    public static function with(string $until, ?string $start = null): self
    {
        $obj = new self;

        $obj->until = $until;

        null !== $start && $obj->start = $start;

        return $obj;
    }

    public function withUntil(string $until): self
    {
        $obj = clone $this;
        $obj->until = $until;

        return $obj;
    }

    public function withStart(?string $start): self
    {
        $obj = clone $this;
        $obj->start = $start;

        return $obj;
    }
}
