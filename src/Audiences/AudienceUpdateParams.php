<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Audiences\Filter\Operator;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Creates or updates audience.
 *
 * @see Courier\Services\AudiencesService::update()
 *
 * @phpstan-type AudienceUpdateParamsShape = array{
 *   description?: string|null,
 *   filter?: null|Filter|array{
 *     operator: value-of<Operator>, path: string, value: string
 *   },
 *   name?: string|null,
 * }
 */
final class AudienceUpdateParams implements BaseModel
{
    /** @use SdkModel<AudienceUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A description of the audience.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * A single filter to use for filtering.
     */
    #[Optional(nullable: true)]
    public ?Filter $filter;

    /**
     * The name of the audience.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Filter|array{
     *   operator: value-of<Operator>, path: string, value: string
     * }|null $filter
     */
    public static function with(
        ?string $description = null,
        Filter|array|null $filter = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        null !== $description && $obj['description'] = $description;
        null !== $filter && $obj['filter'] = $filter;
        null !== $name && $obj['name'] = $name;

        return $obj;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * A single filter to use for filtering.
     *
     * @param Filter|array{
     *   operator: value-of<Operator>, path: string, value: string
     * }|null $filter
     */
    public function withFilter(Filter|array|null $filter): self
    {
        $obj = clone $this;
        $obj['filter'] = $filter;

        return $obj;
    }

    /**
     * The name of the audience.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
