<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\List;
use Courier\Paging;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
  * @phpstan-type list_list_response = array{items: list<List>, paging: Paging}
  * 
 */
final class ListListResponse implements BaseModel, ResponseConverter
{
  /** @use SdkModel<list_list_response> */
  use SdkModel;

  use SdkResponse;

  /** @var list<List> $items */
  #[Api(list: List::class)]
  public array $items;

  /** @var Paging $paging */
  #[Api]
  public Paging $paging;

  /**
  * `new ListListResponse()` is missing required properties by the API.
  * 
  * To enforce required parameters use
  * ```
  * ListListResponse::with(items: ..., paging: ...)
  * ```
  * 
  * Otherwise ensure the following setters are called
  * 
  * ```
  * (new ListListResponse)->withItems(...)->withPaging(...)
  * ```
 */
  public function __construct(){$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  * 
  * You must use named parameters to construct any parameters with a default value.
  * 
  * @param list<List> $items
  * @param Paging $paging
  * 
  * @return self
 */
  public static function with(array $items, Paging $paging): self {
    $obj = new self;

    $obj->items = $items;
    $obj->paging = $paging;

    return $obj;
  }

  /**
  * @param list<List> $items
  * 
  * @return self
 */
  public function withItems(array $items): self {
    $obj = clone $this;
    $obj->items = $items;
    return $obj;
  }

  /**
  * @param Paging $paging
  * 
  * @return self
 */
  public function withPaging(Paging $paging): self {
    $obj = clone $this;
    $obj->paging = $paging;
    return $obj;
  }
}