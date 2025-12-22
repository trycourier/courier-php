<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send via PagerDuty.
 *
 * @phpstan-import-type PagerdutyShape from \Courier\Pagerduty
 *
 * @phpstan-type PagerdutyRecipientShape = array{
 *   pagerduty: Pagerduty|PagerdutyShape
 * }
 */
final class PagerdutyRecipient implements BaseModel
{
    /** @use SdkModel<PagerdutyRecipientShape> */
    use SdkModel;

    #[Required]
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
     *
     * @param Pagerduty|PagerdutyShape $pagerduty
     */
    public static function with(Pagerduty|array $pagerduty): self
    {
        $self = new self;

        $self['pagerduty'] = $pagerduty;

        return $self;
    }

    /**
     * @param Pagerduty|PagerdutyShape $pagerduty
     */
    public function withPagerduty(Pagerduty|array $pagerduty): self
    {
        $self = clone $this;
        $self['pagerduty'] = $pagerduty;

        return $self;
    }
}
