<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendSendMessageParams;
use Courier\Send\SendSendMessageParams\Message;
use Courier\Send\SendSendMessageResponse;
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
     * Use the send API to send a message to one or more recipients.
     *
     * @param Message $message The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @throws APIException
     */
    public function sendMessage(
        $message,
        ?RequestOptions $requestOptions = null
    ): SendSendMessageResponse {
        $params = ['message' => $message];

        return $this->sendMessageRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function sendMessageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendSendMessageResponse {
        [$parsed, $options] = SendSendMessageParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'send',
            body: (object) $parsed,
            options: $options,
            convert: SendSendMessageResponse::class,
        );
    }
}
