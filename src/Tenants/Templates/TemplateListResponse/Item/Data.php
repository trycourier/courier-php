<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse\Item;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageRouting;

/**
 * The template's data containing it's routing configs.
 *
 * @phpstan-import-type MessageRoutingShape from \Courier\MessageRouting
 *
 * @phpstan-type DataShape = array{routing: MessageRouting|MessageRoutingShape}
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
     * @param MessageRoutingShape $routing
     */
    public static function with(MessageRouting|array $routing): self
    {
        $self = new self;

        $self['routing'] = $routing;

        return $self;
    }

    /**
     * @param MessageRoutingShape $routing
     */
    public function withRouting(MessageRouting|array $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }
}
