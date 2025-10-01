<?php

declare(strict_types=1);

namespace Courier\Profiles\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Profiles\Lists\ListSubscribeParams\List;

/**
  * An object containing the method's parameters.
  * Example usage:
  * ```
  * $params = (new ListSubscribeParams); // set properties as needed
  * $client->profiles.lists->subscribe(...$params->toArray());
  * ```
  * Subscribes the given user to one or more lists. If the list does not exist, it will be created.
  * @method toArray()
  *   Returns the parameters as an associative array suitable for passing to the client method.
  * 
  *   `$client->profiles.lists->subscribe(...$params->toArray());`
  * @see Courier\Profiles\Lists->subscribe
  * @phpstan-type list_subscribe_params = array{lists: list<List>}
  * 
 */
final class ListSubscribeParams implements BaseModel
{
  /** @use SdkModel<list_subscribe_params> */
  use SdkModel;
  use SdkParams;

  /** @var list<List> $lists */
  #[Api(list: List::class)]
  public array $lists;

  /**
  * `new ListSubscribeParams()` is missing required properties by the API.
  * 
  * To enforce required parameters use
  * ```
  * ListSubscribeParams::with(lists: ...)
  * ```
  * 
  * Otherwise ensure the following setters are called
  * 
  * ```
  * (new ListSubscribeParams)->withLists(...)
  * ```
 */
  public function __construct(){$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  * 
  * You must use named parameters to construct any parameters with a default value.
  * 
  * @param list<List> $lists
  * 
  * @return self
 */
  public static function with(array $lists): self {
    $obj = new self;

    $obj->lists = $lists;

    return $obj;
  }

  /**
  * @param list<List> $lists
  * 
  * @return self
 */
  public function withLists(array $lists): self {
    $obj = clone $this;
    $obj->lists = $lists;
    return $obj;
  }
}