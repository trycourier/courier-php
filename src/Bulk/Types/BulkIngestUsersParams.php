<?php

namespace Courier\Bulk\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class BulkIngestUsersParams extends JsonSerializableType
{
    /**
     * @var array<InboundBulkMessageUser> $users
     */
    #[JsonProperty('users'), ArrayType([InboundBulkMessageUser::class])]
    public array $users;

    /**
     * @param array{
     *   users: array<InboundBulkMessageUser>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->users = $values['users'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
