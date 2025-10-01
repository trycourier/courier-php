<?php

declare(strict_types=1);

namespace Courier\Auth;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type auth_issue_token_response = array{token?: string|null}
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class AuthIssueTokenResponse implements BaseModel
{
    /** @use SdkModel<auth_issue_token_response> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $token;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $token = null): self
    {
        $obj = new self;

        null !== $token && $obj->token = $token;

        return $obj;
    }

    public function withToken(?string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

        return $obj;
    }
}
