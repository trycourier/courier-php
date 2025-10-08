<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists\ListGetResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;

/**
 * @phpstan-type result_alias = array{
 *   id: string,
 *   created: string,
 *   name: string,
 *   updated: string,
 *   preferences?: RecipientPreferences|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<result_alias> */
    use SdkModel;

    #[Api]
    public string $id;

    /**
     * The date/time of when the list was created. Represented as a string in ISO format.
     */
    #[Api]
    public string $created;

    /**
     * List name.
     */
    #[Api]
    public string $name;

    /**
     * The date/time of when the list was updated. Represented as a string in ISO format.
     */
    #[Api]
    public string $updated;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(id: ..., created: ..., name: ..., updated: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withID(...)->withCreated(...)->withName(...)->withUpdated(...)
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
        string $id,
        string $created,
        string $name,
        string $updated,
        ?RecipientPreferences $preferences = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->created = $created;
        $obj->name = $name;
        $obj->updated = $updated;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * The date/time of when the list was created. Represented as a string in ISO format.
     */
    public function withCreated(string $created): self
    {
        $obj = clone $this;
        $obj->created = $created;

        return $obj;
    }

    /**
     * List name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * The date/time of when the list was updated. Represented as a string in ISO format.
     */
    public function withUpdated(string $updated): self
    {
        $obj = clone $this;
        $obj->updated = $updated;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
