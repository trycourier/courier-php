<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalTextNodeWithType\Type;

/**
 * @phpstan-type ElementalContentShape = array{
 *   elements: list<ElementalTextNodeWithType|ElementalMetaNodeWithType|ElementalChannelNodeWithType|ElementalImageNodeWithType|ElementalActionNodeWithType|ElementalDividerNodeWithType|ElementalQuoteNodeWithType>,
 *   version: string,
 *   brand?: string|null,
 * }
 */
final class ElementalContent implements BaseModel
{
    /** @use SdkModel<ElementalContentShape> */
    use SdkModel;

    /**
     * @var list<ElementalTextNodeWithType|ElementalMetaNodeWithType|ElementalChannelNodeWithType|ElementalImageNodeWithType|ElementalActionNodeWithType|ElementalDividerNodeWithType|ElementalQuoteNodeWithType> $elements
     */
    #[Required(list: ElementalNode::class)]
    public array $elements;

    /**
     * For example, "2022-01-01".
     */
    #[Required]
    public string $version;

    #[Optional(nullable: true)]
    public ?string $brand;

    /**
     * `new ElementalContent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementalContent::with(elements: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementalContent)->withElements(...)->withVersion(...)
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
     * @param list<ElementalTextNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<Type>|null,
     * }|ElementalMetaNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalMetaNodeWithType\Type>|null,
     * }|ElementalChannelNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   channel: string,
     *   raw?: array<string,mixed>|null,
     *   type?: value-of<ElementalChannelNodeWithType\Type>|null,
     * }|ElementalImageNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalImageNodeWithType\Type>|null,
     * }|ElementalActionNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalActionNodeWithType\Type>|null,
     * }|ElementalDividerNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalDividerNodeWithType\Type>|null,
     * }|ElementalQuoteNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalQuoteNodeWithType\Type>|null,
     * }> $elements
     */
    public static function with(
        array $elements,
        string $version,
        ?string $brand = null
    ): self {
        $obj = new self;

        $obj['elements'] = $elements;
        $obj['version'] = $version;

        null !== $brand && $obj['brand'] = $brand;

        return $obj;
    }

    /**
     * @param list<ElementalTextNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<Type>|null,
     * }|ElementalMetaNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalMetaNodeWithType\Type>|null,
     * }|ElementalChannelNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   channel: string,
     *   raw?: array<string,mixed>|null,
     *   type?: value-of<ElementalChannelNodeWithType\Type>|null,
     * }|ElementalImageNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalImageNodeWithType\Type>|null,
     * }|ElementalActionNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalActionNodeWithType\Type>|null,
     * }|ElementalDividerNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalDividerNodeWithType\Type>|null,
     * }|ElementalQuoteNodeWithType|array{
     *   channels?: list<string>|null,
     *   if?: string|null,
     *   loop?: string|null,
     *   ref?: string|null,
     *   type?: value-of<ElementalQuoteNodeWithType\Type>|null,
     * }> $elements
     */
    public function withElements(array $elements): self
    {
        $obj = clone $this;
        $obj['elements'] = $elements;

        return $obj;
    }

    /**
     * For example, "2022-01-01".
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj['version'] = $version;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj['brand'] = $brand;

        return $obj;
    }
}
