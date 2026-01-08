<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsContract;
use Courier\Services\Notifications\ChecksService;
use Courier\Services\Notifications\DraftService;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class NotificationsService implements NotificationsContract
{
    /**
     * @api
     */
    public NotificationsRawService $raw;

    /**
     * @api
     */
    public DraftService $draft;

    /**
     * @api
     */
    public ChecksService $checks;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NotificationsRawService($client);
        $this->draft = new DraftService($client);
        $this->checks = new ChecksService($client);
    }

    /**
     * @api
     *
     * @param bool|null $notes retrieve the notes from the Notification template settings
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?bool $notes = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'notes' => $notes]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): NotificationGetContent {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveContent($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
