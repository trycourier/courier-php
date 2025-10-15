<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type subscribe_to_lists_request_item = array{
 *   listID: string, preferences?: RecipientPreferences|null
 * }
 */
final class SubscribeToListsRequestItem implements BaseModel
{
    /** @use SdkModel<subscribe_to_lists_request_item> */
    use SdkModel;

    #[Api('listId')]
    public string $listID;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new SubscribeToListsRequestItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscribeToListsRequestItem::with(listID: ...)
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
        string $listID,
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->listID = $listID;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj->listID = $listID;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
