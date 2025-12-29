<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendMessageParams\Message\Timeout\Criteria;

/**
 * @phpstan-type TimeoutShape = array{
 *   channel?: array<string,int>|null,
 *   criteria?: null|Criteria|value-of<Criteria>,
 *   escalation?: int|null,
 *   message?: int|null,
 *   provider?: array<string,int>|null,
 * }
 */
final class Timeout implements BaseModel
{
    /** @use SdkModel<TimeoutShape> */
    use SdkModel;

    /** @var array<string,int>|null $channel */
    #[Optional(map: 'int', nullable: true)]
    public ?array $channel;

    /** @var value-of<Criteria>|null $criteria */
    #[Optional(enum: Criteria::class, nullable: true)]
    public ?string $criteria;

    #[Optional(nullable: true)]
    public ?int $escalation;

    #[Optional(nullable: true)]
    public ?int $message;

    /** @var array<string,int>|null $provider */
    #[Optional(map: 'int', nullable: true)]
    public ?array $provider;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,int>|null $channel
     * @param Criteria|value-of<Criteria>|null $criteria
     * @param array<string,int>|null $provider
     */
    public static function with(
        ?array $channel = null,
        Criteria|string|null $criteria = null,
        ?int $escalation = null,
        ?int $message = null,
        ?array $provider = null,
    ): self {
        $self = new self;

        null !== $channel && $self['channel'] = $channel;
        null !== $criteria && $self['criteria'] = $criteria;
        null !== $escalation && $self['escalation'] = $escalation;
        null !== $message && $self['message'] = $message;
        null !== $provider && $self['provider'] = $provider;

        return $self;
    }

    /**
     * @param array<string,int>|null $channel
     */
    public function withChannel(?array $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

        return $self;
    }

    /**
     * @param Criteria|value-of<Criteria>|null $criteria
     */
    public function withCriteria(Criteria|string|null $criteria): self
    {
        $self = clone $this;
        $self['criteria'] = $criteria;

        return $self;
    }

    public function withEscalation(?int $escalation): self
    {
        $self = clone $this;
        $self['escalation'] = $escalation;

        return $self;
    }

    public function withMessage(?int $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * @param array<string,int>|null $provider
     */
    public function withProvider(?array $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }
}
