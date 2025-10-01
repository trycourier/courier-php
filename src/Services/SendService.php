<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;
use Courier\Send\SendMessageParams;
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
     * Use the send API to send a message to one or more recipients.
     *
     * @param ContentMessage|TemplateMessage $message Defines the message to be delivered
     *
     * @return SendMessageResponse<HasRawResponse>
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
     * @return SendMessageResponse<HasRawResponse>
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
