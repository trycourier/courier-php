<?php

declare(strict_types=1);

namespace Courier\Providers;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Providers\ProviderPatchParams\Patch;

/**
 * Applies JSON Patch (RFC 6902) operations to a provider configuration and keeps every field the operations don't touch. Paths address the provider as it is returned: /title, /alias and /settings/<key>. The operations apply in order, and if one fails, nothing is saved.
 *
 * @see Courier\Services\ProvidersService::patch()
 *
 * @phpstan-import-type PatchShape from \Courier\Providers\ProviderPatchParams\Patch
 *
 * @phpstan-type ProviderPatchParamsShape = array{patch: list<Patch|PatchShape>}
 */
final class ProviderPatchParams implements BaseModel
{
    /** @use SdkModel<ProviderPatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Operations to apply, in order. Paths address the provider as it is returned: `/title`, `/alias`, `/provider`, and `/settings/<key>` with the snake_case setting keys, including nested paths such as `/settings/rate_limit/rate`. If any operation fails, for example a `test`, nothing is saved and the request returns a 400. The result can't change `provider`, remove `title`, or add other top-level fields. Removing `/alias` clears it.
     *
     * @var list<Patch> $patch
     */
    #[Required(list: Patch::class)]
    public array $patch;

    /**
     * `new ProviderPatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderPatchParams::with(patch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderPatchParams)->withPatch(...)
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
     * @param list<Patch|PatchShape> $patch
     */
    public static function with(array $patch): self
    {
        $self = new self;

        $self['patch'] = $patch;

        return $self;
    }

    /**
     * Operations to apply, in order. Paths address the provider as it is returned: `/title`, `/alias`, `/provider`, and `/settings/<key>` with the snake_case setting keys, including nested paths such as `/settings/rate_limit/rate`. If any operation fails, for example a `test`, nothing is saved and the request returns a 400. The result can't change `provider`, remove `title`, or add other top-level fields. Removing `/alias` clears it.
     *
     * @param list<Patch|PatchShape> $patch
     */
    public function withPatch(array $patch): self
    {
        $self = clone $this;
        $self['patch'] = $patch;

        return $self;
    }
}
