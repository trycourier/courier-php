<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists\ListSubscribeParams;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\RecipientPreferences;

/**
  * @phpstan-type list_alias = array{
  *   listID: string, preferences?: RecipientPreferences|null
  * }
  * 
 */
final class List implements BaseModel
{
  /** @use SdkModel<list_alias> */
  use SdkModel;

  /** @var string $listID */
  #[Api("listId")]
  public string $listID;

  /** @var RecipientPreferences|null $preferences */
  #[Api(nullable: true, optional: true)]
  public ?RecipientPreferences $preferences;

  /**
  * `new List()` is missing required properties by the API.
  * 
  * To enforce required parameters use
  * ```
  * List::with(listID: ...)
  * ```
  * 
  * Otherwise ensure the following setters are called
  * 
  * ```
  * (new List)->withListID(...)
  * ```
 */
  public function __construct(){$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  * 
  * You must use named parameters to construct any parameters with a default value.
  * 
  * @param string $listID
  * @param RecipientPreferences|null $preferences
  * 
  * @return self
 */
  public static function with(
    string $listID, ?RecipientPreferences $preferences = null
  ): self {
    $obj = new self;

    $obj->listID = $listID;

    null !== $preferences && $obj->preferences = $preferences;

    return $obj;
  }

  /**
  * @param string $listID
  * 
  * @return self
 */
  public function withListID(string $listID): self {
    $obj = clone $this;
    $obj->listID = $listID;
    return $obj;
  }

  /**
  * @param RecipientPreferences|null $preferences
  * 
  * @return self
 */
  public function withPreferences(?RecipientPreferences $preferences): self {
    $obj = clone $this;
    $obj->preferences = $preferences;
    return $obj;
  }
}