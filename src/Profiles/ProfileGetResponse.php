<?php

declare(strict_types=1);

namespace Courier\Profiles;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\Subscriptions\RecipientPreferences;

/**
 * @phpstan-type profile_get_response = array{
 *   profile: array<string, mixed>, preferences?: RecipientPreferences|null
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class ProfileGetResponse implements BaseModel
{
    /** @use SdkModel<profile_get_response> */
    use SdkModel;

    /** @var array<string, mixed> $profile */
    #[Api(map: 'mixed')]
    public array $profile;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new ProfileGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileGetResponse::with(profile: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileGetResponse)->withProfile(...)
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
     * @param array<string, mixed> $profile
     */
    public static function with(
        array $profile,
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->profile = $profile;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    /**
     * @param array<string, mixed> $profile
     */
    public function withProfile(array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
