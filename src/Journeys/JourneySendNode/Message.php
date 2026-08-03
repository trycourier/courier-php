<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneySendNode\Message\Context;
use Courier\Journeys\JourneySendNode\Message\Delay;
use Courier\Journeys\JourneySendNode\Message\To;

/**
 * @phpstan-import-type ContextShape from \Courier\Journeys\JourneySendNode\Message\Context
 * @phpstan-import-type DelayShape from \Courier\Journeys\JourneySendNode\Message\Delay
 * @phpstan-import-type ToShape from \Courier\Journeys\JourneySendNode\Message\To
 *
 * @phpstan-type MessageShape = array{
 *   context?: null|Context|ContextShape,
 *   data?: array<string,mixed>|null,
 *   delay?: null|Delay|DelayShape,
 *   template?: string|null,
 *   to?: null|To|ToShape,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    /**
     * Tenant context for this send. Set it to deliver on behalf of one of your customers, so the message uses that tenant's brand and settings.
     */
    #[Optional]
    public ?Context $context;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed')]
    public ?array $data;

    #[Optional]
    public ?Delay $delay;

    #[Optional]
    public ?string $template;

    #[Optional]
    public ?To $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Context|ContextShape|null $context
     * @param array<string,mixed>|null $data
     * @param Delay|DelayShape|null $delay
     * @param To|ToShape|null $to
     */
    public static function with(
        Context|array|null $context = null,
        ?array $data = null,
        Delay|array|null $delay = null,
        ?string $template = null,
        To|array|null $to = null,
    ): self {
        $self = new self;

        null !== $context && $self['context'] = $context;
        null !== $data && $self['data'] = $data;
        null !== $delay && $self['delay'] = $delay;
        null !== $template && $self['template'] = $template;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * Tenant context for this send. Set it to deliver on behalf of one of your customers, so the message uses that tenant's brand and settings.
     *
     * @param Context|ContextShape $context
     */
    public function withContext(Context|array $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    /**
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param Delay|DelayShape $delay
     */
    public function withDelay(Delay|array $delay): self
    {
        $self = clone $this;
        $self['delay'] = $delay;

        return $self;
    }

    public function withTemplate(string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }

    /**
     * @param To|ToShape $to
     */
    public function withTo(To|array $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
