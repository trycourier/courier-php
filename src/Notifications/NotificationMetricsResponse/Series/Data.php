<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationMetricsResponse\Series;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   channel: string,
 *   clicked: int,
 *   delivered: int,
 *   errors: int,
 *   opened: int,
 *   provider: string,
 *   sent: int,
 *   undeliverable: int,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Channel the provider delivered on, e.g. `email`.
     */
    #[Required]
    public string $channel;

    /**
     * Messages with at least one tracked link click.
     */
    #[Required]
    public int $clicked;

    /**
     * Messages the provider confirmed as delivered.
     */
    #[Required]
    public int $delivered;

    /**
     * Messages the provider rejected or failed on, including ones a later provider then delivered.
     */
    #[Required]
    public int $errors;

    /**
     * Messages opened at least once. Always `0` on channels with no open tracking.
     */
    #[Required]
    public int $opened;

    /**
     * Provider that handled the messages, e.g. `sendgrid`.
     */
    #[Required]
    public string $provider;

    /**
     * Messages handed to the provider.
     */
    #[Required]
    public int $sent;

    /**
     * Messages Courier could not deliver on any provider for the channel.
     */
    #[Required]
    public int $undeliverable;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   channel: ...,
     *   clicked: ...,
     *   delivered: ...,
     *   errors: ...,
     *   opened: ...,
     *   provider: ...,
     *   sent: ...,
     *   undeliverable: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withChannel(...)
     *   ->withClicked(...)
     *   ->withDelivered(...)
     *   ->withErrors(...)
     *   ->withOpened(...)
     *   ->withProvider(...)
     *   ->withSent(...)
     *   ->withUndeliverable(...)
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
    public static function with(
        string $channel,
        int $clicked,
        int $delivered,
        int $errors,
        int $opened,
        string $provider,
        int $sent,
        int $undeliverable,
    ): self {
        $self = new self;

        $self['channel'] = $channel;
        $self['clicked'] = $clicked;
        $self['delivered'] = $delivered;
        $self['errors'] = $errors;
        $self['opened'] = $opened;
        $self['provider'] = $provider;
        $self['sent'] = $sent;
        $self['undeliverable'] = $undeliverable;

        return $self;
    }

    /**
     * Channel the provider delivered on, e.g. `email`.
     */
    public function withChannel(string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * Messages with at least one tracked link click.
     */
    public function withClicked(int $clicked): self
    {
        $self = clone $this;
        $self['clicked'] = $clicked;

        return $self;
    }

    /**
     * Messages the provider confirmed as delivered.
     */
    public function withDelivered(int $delivered): self
    {
        $self = clone $this;
        $self['delivered'] = $delivered;

        return $self;
    }

    /**
     * Messages the provider rejected or failed on, including ones a later provider then delivered.
     */
    public function withErrors(int $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    /**
     * Messages opened at least once. Always `0` on channels with no open tracking.
     */
    public function withOpened(int $opened): self
    {
        $self = clone $this;
        $self['opened'] = $opened;

        return $self;
    }

    /**
     * Provider that handled the messages, e.g. `sendgrid`.
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Messages handed to the provider.
     */
    public function withSent(int $sent): self
    {
        $self = clone $this;
        $self['sent'] = $sent;

        return $self;
    }

    /**
     * Messages Courier could not deliver on any provider for the channel.
     */
    public function withUndeliverable(int $undeliverable): self
    {
        $self = clone $this;
        $self['undeliverable'] = $undeliverable;

        return $self;
    }
}
