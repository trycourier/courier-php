<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send via webhook.
 *
 * @phpstan-import-type WebhookProfileShape from \Courier\WebhookProfile
 *
 * @phpstan-type WebhookRecipientShape = array{
 *   webhook: WebhookProfile|WebhookProfileShape
 * }
 */
final class WebhookRecipient implements BaseModel
{
    /** @use SdkModel<WebhookRecipientShape> */
    use SdkModel;

    #[Required]
    public WebhookProfile $webhook;

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
     *
     * @param WebhookProfile|WebhookProfileShape $webhook
     */
    public static function with(WebhookProfile|array $webhook): self
    {
        $self = new self;

        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * @param WebhookProfile|WebhookProfileShape $webhook
     */
    public function withWebhook(WebhookProfile|array $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }
}
