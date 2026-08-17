<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Routes a push notification through the AWS SNS provider. The target ARN must be nested under `aws_sns` — a top-level `target_arn` on the profile is ignored by the provider.
 *
 * @phpstan-type AwsSnsShape = array{targetArn: string}
 */
final class AwsSns implements BaseModel
{
    /** @use SdkModel<AwsSnsShape> */
    use SdkModel;

    /**
     * The ARN of the SNS platform endpoint, topic, or application to publish to.
     */
    #[Required('target_arn')]
    public string $targetArn;

    /**
     * `new AwsSns()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AwsSns::with(targetArn: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AwsSns)->withTargetArn(...)
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
    public static function with(string $targetArn): self
    {
        $self = new self;

        $self['targetArn'] = $targetArn;

        return $self;
    }

    /**
     * The ARN of the SNS platform endpoint, topic, or application to publish to.
     */
    public function withTargetArn(string $targetArn): self
    {
        $self = clone $this;
        $self['targetArn'] = $targetArn;

        return $self;
    }
}
