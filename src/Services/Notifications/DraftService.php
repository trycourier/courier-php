<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\DraftContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class DraftService implements DraftContract
{
    /**
     * @api
     */
    public DraftRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DraftRawService($client);
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
