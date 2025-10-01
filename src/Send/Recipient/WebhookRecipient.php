<?php

declare(strict_types=1);

namespace Courier\Send\Recipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Recipient\WebhookRecipient\Webhook;

/**
 * @phpstan-type webhook_recipient = array{webhook: Webhook}
 */
final class WebhookRecipient implements BaseModel
{
    /** @use SdkModel<webhook_recipient> */
    use SdkModel;

    #[Api]
    public Webhook $webhook;

    /**
     * `new WebhookRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookRecipient::with(webhook: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookRecipient)->withWebhook(...)
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
    public static function with(Webhook $webhook): self
    {
        $obj = new self;

        $obj->webhook = $webhook;

        return $obj;
    }

    public function withWebhook(Webhook $webhook): self
    {
        $obj = clone $this;
        $obj->webhook = $webhook;

        return $obj;
    }
}
