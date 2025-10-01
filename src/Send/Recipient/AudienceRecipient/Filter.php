<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\AudienceRecipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Recipient\AudienceRecipient\Filter\Operator;
use Courier\Send\Recipient\AudienceRecipient\Filter\Path;

/**
 * @phpstan-type filter_alias = array{
 *   operator: value-of<Operator>, path: value-of<Path>, value: string
 * }
 */
final class Filter implements BaseModel
{
    /** @use SdkModel<filter_alias> */
    use SdkModel;

    /**
     * Send to users only if they are member of the account.
     *
     * @var value-of<Operator> $operator
     */
    #[Api(enum: Operator::class)]
    public string $operator;

    /** @var value-of<Path> $path */
    #[Api(enum: Path::class)]
    public string $path;

    #[Api]
    public string $value;

    /**
     * `new Filter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Filter::with(operator: ..., path: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Filter)->withOperator(...)->withPath(...)->withValue(...)
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
     * @param Operator|value-of<Operator> $operator
     * @param Path|value-of<Path> $path
     */
    public static function with(
        Operator|string $operator,
        Path|string $path,
        string $value
    ): self {
        $obj = new self;

        $obj->operator = $operator instanceof Operator ? $operator->value : $operator;
        $obj->path = $path instanceof Path ? $path->value : $path;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Send to users only if they are member of the account.
     *
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $obj = clone $this;
        $obj->operator = $operator instanceof Operator ? $operator->value : $operator;

        return $obj;
    }

    /**
     * @param Path|value-of<Path> $path
     */
    public function withPath(Path|string $path): self
    {
        $obj = clone $this;
        $obj->path = $path instanceof Path ? $path->value : $path;

        return $obj;
    }

    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
