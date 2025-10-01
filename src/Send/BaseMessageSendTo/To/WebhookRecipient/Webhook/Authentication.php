<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook\Authentication\Mode;

/**
 * Authentication configuration for the webhook request.
 *
 * @phpstan-type authentication_alias = array{
 *   mode: value-of<Mode>,
 *   token?: string|null,
 *   password?: string|null,
 *   username?: string|null,
 * }
 */
final class Authentication implements BaseModel
{
    /** @use SdkModel<authentication_alias> */
    use SdkModel;

    /**
     * The authentication mode to use. Defaults to 'none' if not specified.
     *
     * @var value-of<Mode> $mode
     */
    #[Api(enum: Mode::class)]
    public string $mode;

    /**
     * Token for bearer authentication.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $token;

    /**
     * Password for basic authentication.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $password;

    /**
     * Username for basic authentication.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $username;

    /**
     * `new Authentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Authentication::with(mode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Authentication)->withMode(...)
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
     * @param Mode|value-of<Mode> $mode
     */
    public static function with(
        Mode|string $mode,
        ?string $token = null,
        ?string $password = null,
        ?string $username = null,
    ): self {
        $obj = new self;

        $obj->mode = $mode instanceof Mode ? $mode->value : $mode;

        null !== $token && $obj->token = $token;
        null !== $password && $obj->password = $password;
        null !== $username && $obj->username = $username;

        return $obj;
    }

    /**
     * The authentication mode to use. Defaults to 'none' if not specified.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $obj = clone $this;
        $obj->mode = $mode instanceof Mode ? $mode->value : $mode;

        return $obj;
    }

    /**
     * Token for bearer authentication.
     */
    public function withToken(?string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

        return $obj;
    }

    /**
     * Password for basic authentication.
     */
    public function withPassword(?string $password): self
    {
        $obj = clone $this;
        $obj->password = $password;

        return $obj;
    }

    /**
     * Username for basic authentication.
     */
    public function withUsername(?string $username): self
    {
        $obj = clone $this;
        $obj->username = $username;

        return $obj;
    }
}
