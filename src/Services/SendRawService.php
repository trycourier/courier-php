<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendRawContract;

/**
 * Send a message to one or more recipients — users, lists, audiences, or tenants — across every channel you have configured.
 *
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
     * Sends a message to one or more recipients and returns a requestId. Courier routes it to email, SMS, push, chat, or in-app based on your rules. Use the returned requestId to look up delivery status via the Messages API.
     *
     * @param array{
     *   message: Message|MessageShape,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|SendMessageParams $params
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
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'send',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SendMessageResponse::class,
        );
    }
}
