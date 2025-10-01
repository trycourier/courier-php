<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\AudienceRecipient\Filter;

/**
 * @phpstan-type audience_recipient = array{
 *   audienceID: string,
 *   data?: array<string, mixed>|null,
 *   filters?: list<Filter>|null,
 * }
 */
final class AudienceRecipient implements BaseModel
{
    /** @use SdkModel<audience_recipient> */
    use SdkModel;

    /**
     * A unique identifier associated with an Audience. A message will be sent to each user in the audience.
     */
    #[Api('audience_id')]
    public string $audienceID;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var list<Filter>|null $filters */
    #[Api(list: Filter::class, nullable: true, optional: true)]
    public ?array $filters;

    /**
     * `new AudienceRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceRecipient::with(audienceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceRecipient)->withAudienceID(...)
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
     * @param array<string, mixed>|null $data
     * @param list<Filter>|null $filters
     */
    public static function with(
        string $audienceID,
        ?array $data = null,
        ?array $filters = null
    ): self {
        $obj = new self;

        $obj->audienceID = $audienceID;

        null !== $data && $obj->data = $data;
        null !== $filters && $obj->filters = $filters;

        return $obj;
    }

    /**
     * A unique identifier associated with an Audience. A message will be sent to each user in the audience.
     */
    public function withAudienceID(string $audienceID): self
    {
        $obj = clone $this;
        $obj->audienceID = $audienceID;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * @param list<Filter>|null $filters
     */
    public function withFilters(?array $filters): self
    {
        $obj = clone $this;
        $obj->filters = $filters;

        return $obj;
    }
}
