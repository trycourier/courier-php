<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists\ListGetResponse;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 *
 * @phpstan-type ResultShape = array{
 *   id: string,
 *   created: string,
 *   name: string,
 *   updated: string,
 *   preferences?: null|RecipientPreferences|RecipientPreferencesShape,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * The date/time of when the list was created. Represented as a string in ISO format.
     */
    #[Required]
    public string $created;

    /**
     * List name.
     */
    #[Required]
    public string $name;

    /**
     * The date/time of when the list was updated. Represented as a string in ISO format.
     */
    #[Required]
    public string $updated;

    #[Optional(nullable: true)]
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
     *
     * @param RecipientPreferencesShape|null $preferences
     */
    public static function with(
        string $id,
        string $created,
        string $name,
        string $updated,
        RecipientPreferences|array|null $preferences = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['name'] = $name;
        $self['updated'] = $updated;

        null !== $preferences && $self['preferences'] = $preferences;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The date/time of when the list was created. Represented as a string in ISO format.
     */
    public function withCreated(string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * List name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The date/time of when the list was updated. Represented as a string in ISO format.
     */
    public function withUpdated(string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * @param RecipientPreferencesShape|null $preferences
     */
    public function withPreferences(
        RecipientPreferences|array|null $preferences
    ): self {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }
}
