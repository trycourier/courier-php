<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendContract;

final class SendService implements SendContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * API to send a message to one or more recipients.
     *
     * @param Message $message The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @throws APIException
     */
    public function message(
        $message,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse {
        $params = ['message' => $message];

        return $this->messageRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function messageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse {
        [$parsed, $options] = SendMessageParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'send',
            body: (object) $parsed,
            options: $options,
            convert: SendMessageResponse::class,
        );
    }
}
