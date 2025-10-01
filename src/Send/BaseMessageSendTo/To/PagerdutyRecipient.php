<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\PagerdutyRecipient\Pagerduty;

/**
 * @phpstan-type pagerduty_recipient = array{pagerduty: Pagerduty}
 */
final class PagerdutyRecipient implements BaseModel
{
    /** @use SdkModel<pagerduty_recipient> */
    use SdkModel;

    #[Api]
    public Pagerduty $pagerduty;

    /**
     * `new PagerdutyRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PagerdutyRecipient::with(pagerduty: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PagerdutyRecipient)->withPagerduty(...)
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
    public static function with(Pagerduty $pagerduty): self
    {
        $obj = new self;

        $obj->pagerduty = $pagerduty;

        return $obj;
    }

    public function withPagerduty(Pagerduty $pagerduty): self
    {
        $obj = clone $this;
        $obj->pagerduty = $pagerduty;

        return $obj;
    }
}
