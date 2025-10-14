<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\NotificationGetContent;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\DraftContract;

final class DraftService implements DraftContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): NotificationGetContent {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/draft/content', $id],
            options: $requestOptions,
            convert: NotificationGetContent::class,
        );
    }
}
