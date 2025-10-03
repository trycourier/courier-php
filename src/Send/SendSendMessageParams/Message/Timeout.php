<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendSendMessageParams\Message\Timeout\Criteria;

/**
 * @phpstan-type timeout_alias = array{
 *   channel?: array<string, int>|null,
 *   criteria?: value-of<Criteria>|null,
 *   escalation?: int|null,
 *   message?: int|null,
 *   provider?: array<string, int>|null,
 * }
 */
final class Timeout implements BaseModel
{
    /** @use SdkModel<timeout_alias> */
    use SdkModel;

    /** @var array<string, int>|null $channel */
    #[Api(map: 'int', nullable: true, optional: true)]
    public ?array $channel;

    /** @var value-of<Criteria>|null $criteria */
    #[Api(enum: Criteria::class, nullable: true, optional: true)]
    public ?string $criteria;

    #[Api(nullable: true, optional: true)]
    public ?int $escalation;

    #[Api(nullable: true, optional: true)]
    public ?int $message;

    /** @var array<string, int>|null $provider */
    #[Api(map: 'int', nullable: true, optional: true)]
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
     * @param array<string, int>|null $channel
     * @param Criteria|value-of<Criteria>|null $criteria
     * @param array<string, int>|null $provider
     */
    public static function with(
        ?array $channel = null,
        Criteria|string|null $criteria = null,
        ?int $escalation = null,
        ?int $message = null,
        ?array $provider = null,
    ): self {
        $obj = new self;

        null !== $channel && $obj->channel = $channel;
        null !== $criteria && $obj->criteria = $criteria instanceof Criteria ? $criteria->value : $criteria;
        null !== $escalation && $obj->escalation = $escalation;
        null !== $message && $obj->message = $message;
        null !== $provider && $obj->provider = $provider;

        return $obj;
    }

    /**
     * @param array<string, int>|null $channel
     */
    public function withChannel(?array $channel): self
    {
        $obj = clone $this;
        $obj->channel = $channel;

        return $obj;
    }

    /**
     * @param Criteria|value-of<Criteria>|null $criteria
     */
    public function withCriteria(Criteria|string|null $criteria): self
    {
        $obj = clone $this;
        $obj->criteria = $criteria instanceof Criteria ? $criteria->value : $criteria;

        return $obj;
    }

    public function withEscalation(?int $escalation): self
    {
        $obj = clone $this;
        $obj->escalation = $escalation;

        return $obj;
    }

    public function withMessage(?int $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }

    /**
     * @param array<string, int>|null $provider
     */
    public function withProvider(?array $provider): self
    {
        $obj = clone $this;
        $obj->provider = $provider;

        return $obj;
    }
}
