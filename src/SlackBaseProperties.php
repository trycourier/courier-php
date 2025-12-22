<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SlackBasePropertiesShape = array{accessToken: string}
 */
final class SlackBaseProperties implements BaseModel
{
    /** @use SdkModel<SlackBasePropertiesShape> */
    use SdkModel;

    #[Required('access_token')]
    public string $accessToken;

    /**
     * `new SlackBaseProperties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SlackBaseProperties::with(accessToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SlackBaseProperties)->withAccessToken(...)
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
    public static function with(string $accessToken): self
    {
        $self = new self;

        $self['accessToken'] = $accessToken;

        return $self;
    }

    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }
}
