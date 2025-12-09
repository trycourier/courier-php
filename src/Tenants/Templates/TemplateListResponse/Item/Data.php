<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse\Item;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;
use Courier\MessageRouting\Method;

/**
 * The template's data containing it's routing configs.
 *
 * @phpstan-type DataShape = array{routing: MessageRouting}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public MessageRouting $routing;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(routing: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withRouting(...)
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
     * @param MessageRouting|array{
     *   channels: list<mixed>, method: value-of<Method>
     * } $routing
     */
    public static function with(MessageRouting|array $routing): self
    {
        $obj = new self;

        $obj['routing'] = $routing;

        return $obj;
    }

    /**
     * @param MessageRouting|array{
     *   channels: list<mixed>, method: value-of<Method>
     * } $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $obj = clone $this;
        $obj['routing'] = $routing;

        return $obj;
    }
}
