<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\RecipientPreferences;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ListUpdateParams); // set properties as needed
 * $client->lists->update(...$params->toArray());
 * ```
 * Create or replace an existing list with the supplied values.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->lists->update(...$params->toArray());`
 *
 * @see Courier\Lists->update
 *
 * @phpstan-type list_update_params = array{
 *   name: string, preferences?: RecipientPreferences|null
 * }
 */
final class ListUpdateParams implements BaseModel
{
    /** @use SdkModel<list_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $name;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new ListUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ListUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ListUpdateParams)->withName(...)
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
        string $name,
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->name = $name;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
