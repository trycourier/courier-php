<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;

/**
 * @phpstan-type SubscribeToListsRequestItemShape = array{
 *   listId: string, preferences?: RecipientPreferences|null
 * }
 */
final class SubscribeToListsRequestItem implements BaseModel
{
    /** @use SdkModel<SubscribeToListsRequestItemShape> */
    use SdkModel;

    #[Api]
    public string $listId;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new SubscribeToListsRequestItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscribeToListsRequestItem::with(listId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscribeToListsRequestItem)->withListID(...)
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
        string $listId,
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->listId = $listId;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj->listId = $listID;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
