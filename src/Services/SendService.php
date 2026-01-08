<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendContract;

/**
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class SendService implements SendContract
{
    /**
     * @api
     */
    public SendRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SendRawService($client);
    }

    /**
     * @api
     *
     * Send a message to one or more recipients.
     *
     * @param Message|MessageShape $message The message property has the following primary top-level properties. They define the destination and content of the message.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function message(
        Message|array $message,
        RequestOptions|array|null $requestOptions = null
    ): SendMessageResponse {
        $params = Util::removeNulls(['message' => $message]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->message(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
