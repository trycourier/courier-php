<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;

/**
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SendContract
{
    /**
     * @api
     *
     * @param Message|MessageShape $message Body param: The message property has the following primary top-level properties. They define the destination and content of the message.
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function message(
        Message|array $message,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): SendMessageResponse;
}
