<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendRawContract;

/**
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class SendRawService implements SendRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Send a message to one or more recipients.
     *
     * @param array{message: Message|MessageShape}|SendMessageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SendMessageResponse>
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SendMessageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'send',
            body: (object) $parsed,
            options: $options,
            convert: SendMessageResponse::class,
        );
    }
}
