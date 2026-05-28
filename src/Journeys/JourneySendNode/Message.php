<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneySendNode\Message\Delay;
use Courier\Journeys\JourneySendNode\Message\To;

/**
 * @phpstan-import-type DelayShape from \Courier\Journeys\JourneySendNode\Message\Delay
 * @phpstan-import-type ToShape from \Courier\Journeys\JourneySendNode\Message\To
 *
 * @phpstan-type MessageShape = array{
 *   template: string,
 *   data?: array<string,mixed>|null,
 *   delay?: null|Delay|DelayShape,
 *   to?: null|To|ToShape,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    #[Required]
    public string $template;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed')]
    public ?array $data;

    #[Optional]
    public ?Delay $delay;

    #[Optional]
    public ?To $to;

    /**
     * `new Message()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Message::with(template: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Message)->withTemplate(...)
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
     * @param array<string,mixed>|null $data
     * @param Delay|DelayShape|null $delay
     * @param To|ToShape|null $to
     */
    public static function with(
        string $template,
        ?array $data = null,
        Delay|array|null $delay = null,
        To|array|null $to = null,
    ): self {
        $self = new self;

        $self['template'] = $template;

        null !== $data && $self['data'] = $data;
        null !== $delay && $self['delay'] = $delay;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    public function withTemplate(string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

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
