<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\DraftRawContract;

final class DraftRawService implements DraftRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @return BaseResponse<NotificationGetContent>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/draft/content', $id],
            options: $requestOptions,
            convert: NotificationGetContent::class,
        );
    }
}
