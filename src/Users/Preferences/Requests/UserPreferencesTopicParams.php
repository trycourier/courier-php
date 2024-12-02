<?php

namespace Courier\Users\Preferences\Requests;

use Courier\Core\Json\JsonSerializableType;

class UserPreferencesTopicParams extends JsonSerializableType
{
    /**
     * @var ?string $tenantId Query the preferences of a user for this specific tenant context.
     */
    public ?string $tenantId;

    /**
     * @param array{
     *   tenantId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tenantId = $values['tenantId'] ?? null;
    }
}
