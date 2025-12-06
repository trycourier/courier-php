<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;

/**
 * Create or replace an existing list with the supplied values.
 *
 * @see Courier\Services\ListsService::update()
 *
 * @phpstan-type ListUpdateParamsShape = array{
 *   name: string,
 *   preferences?: null|RecipientPreferences|array{
 *     categories?: array<string,NotificationPreferenceDetails>|null,
 *     notifications?: array<string,NotificationPreferenceDetails>|null,
 *   },
 * }
 */
final class ListUpdateParams implements BaseModel
{
    /** @use SdkModel<ListUpdateParamsShape> */
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
     *
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public static function with(
        string $name,
        RecipientPreferences|array|null $preferences = null
    ): self {
        $obj = new self;

        $obj['name'] = $name;

        null !== $preferences && $obj['preferences'] = $preferences;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public function withPreferences(
        RecipientPreferences|array|null $preferences
    ): self {
        $obj = clone $this;
        $obj['preferences'] = $preferences;

        return $obj;
    }
}
