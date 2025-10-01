<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type slack_base_properties = array{accessToken: string}
 */
final class SlackBaseProperties implements BaseModel
{
    /** @use SdkModel<slack_base_properties> */
    use SdkModel;

    #[Api('access_token')]
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
        $obj = new self;

        $obj->accessToken = $accessToken;

        return $obj;
    }

    public function withAccessToken(string $accessToken): self
    {
        $obj = clone $this;
        $obj->accessToken = $accessToken;

        return $obj;
    }
}
