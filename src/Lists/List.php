<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
  * @phpstan-type list_alias = array{
  *   id: string, name: string, created?: string|null, updated?: string|null
  * }
  * 
  * 
  * When used in a response, this type parameter can define a $rawResponse property.
  * @template TRawResponse of object = object{}
  * @mixin TRawResponse
  * 
 */
final class List implements BaseModel
{
  /** @use SdkModel<list_alias> */
  use SdkModel;

  /** @var string $id */
  #[Api]
  public string $id;

  /** @var string $name */
  #[Api]
  public string $name;

  /** @var string|null $created */
  #[Api(nullable: true, optional: true)]
  public ?string $created;

  /** @var string|null $updated */
  #[Api(nullable: true, optional: true)]
  public ?string $updated;

  /**
  * `new List()` is missing required properties by the API.
  * 
  * To enforce required parameters use
  * ```
  * List::with(id: ..., name: ...)
  * ```
  * 
  * Otherwise ensure the following setters are called
  * 
  * ```
  * (new List)->withID(...)->withName(...)
  * ```
 */
  public function __construct(){$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  * 
  * You must use named parameters to construct any parameters with a default value.
  * 
  * @param string $id
  * @param string $name
  * @param string|null $created
  * @param string|null $updated
  * 
  * @return self
 */
  public static function with(
    string $id, string $name, ?string $created = null, ?string $updated = null
  ): self {
    $obj = new self;

    $obj->id = $id;
    $obj->name = $name;

    null !== $created && $obj->created = $created;
    null !== $updated && $obj->updated = $updated;

    return $obj;
  }

  /**
  * @param string $id
  * 
  * @return self
 */
  public function withID(string $id): self {
    $obj = clone $this;
    $obj->id = $id;
    return $obj;
  }

  /**
  * @param string $name
  * 
  * @return self
 */
  public function withName(string $name): self {
    $obj = clone $this;
    $obj->name = $name;
    return $obj;
  }

  /**
  * @param string|null $created
  * 
  * @return self
 */
  public function withCreated(?string $created): self {
    $obj = clone $this;
    $obj->created = $created;
    return $obj;
  }

  /**
  * @param string|null $updated
  * 
  * @return self
 */
  public function withUpdated(?string $updated): self {
    $obj = clone $this;
    $obj->updated = $updated;
    return $obj;
  }
}