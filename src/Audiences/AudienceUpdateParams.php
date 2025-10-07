<?php

declare(strict_types=1);

namespace Courier\Audiences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new AudienceUpdateParams); // set properties as needed
 * $client->audiences->update(...$params->toArray());
 * ```
 * Creates or updates audience.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->audiences->update(...$params->toArray());`
 *
 * @see Courier\Audiences->update
 *
 * @phpstan-type audience_update_params = array{
 *   description?: string|null, filter?: Filter|null, name?: string|null
 * }
 */
final class AudienceUpdateParams implements BaseModel
{
    /** @use SdkModel<audience_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A description of the audience.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * A single filter to use for filtering.
     */
    #[Api(nullable: true, optional: true)]
    public ?Filter $filter;

    /**
     * The name of the audience.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

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
        ?string $description = null,
        ?Filter $filter = null,
        ?string $name = null
    ): self {
        $obj = new self;

        null !== $description && $obj->description = $description;
        null !== $filter && $obj->filter = $filter;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * A description of the audience.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * A single filter to use for filtering.
     */
    public function withFilter(?Filter $filter): self
    {
        $obj = clone $this;
        $obj->filter = $filter;

        return $obj;
    }

    /**
     * The name of the audience.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
