<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\MessageContext;
use Courier\MessageRoutingChannel;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageParams\Message\Channel\RoutingMethod;
use Courier\Send\SendMessageParams\Message\Routing\Method;
use Courier\Send\SendMessageParams\Message\Timeout\Criteria;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendRawContract;
use Courier\UserRecipient;

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
     * @param array{
     *   message: array{
     *     brandID?: string|null,
     *     channels?: array<string,array{
     *       brandID?: string|null,
     *       if?: string|null,
     *       metadata?: array<mixed>|null,
     *       override?: array<string,mixed>|null,
     *       providers?: list<string>|null,
     *       routingMethod?: 'all'|'single'|RoutingMethod|null,
     *       timeouts?: array<mixed>|null,
     *     }>|null,
     *     content?: array<string,mixed>,
     *     context?: array{tenantID?: string|null}|MessageContext|null,
     *     data?: array<string,mixed>|null,
     *     delay?: array{duration?: int|null, until?: string|null}|null,
     *     expiry?: array{expiresIn: string|int, expiresAt?: string|null}|null,
     *     metadata?: array{
     *       event?: string|null,
     *       tags?: list<string>|null,
     *       traceID?: string|null,
     *       utm?: array{
     *         campaign?: string|null,
     *         content?: string|null,
     *         medium?: string|null,
     *         source?: string|null,
     *         term?: string|null,
     *       }|null,
     *     }|null,
     *     preferences?: array{subscriptionTopicID: string}|null,
     *     providers?: array<string,array{
     *       if?: string|null,
     *       metadata?: array<mixed>|null,
     *       override?: array<string,mixed>|null,
     *       timeouts?: int|null,
     *     }>|null,
     *     routing?: array{
     *       channels: list<mixed|string|MessageRoutingChannel>,
     *       method: 'all'|'single'|Method,
     *     }|null,
     *     template?: string|null,
     *     timeout?: array{
     *       channel?: array<string,int>|null,
     *       criteria?: 'no-escalation'|'delivered'|'viewed'|'engaged'|Criteria|null,
     *       escalation?: int|null,
     *       message?: int|null,
     *       provider?: array<string,int>|null,
     *     }|null,
     *     to?: array{
     *       accountID?: string|null,
     *       context?: array<mixed>|MessageContext|null,
     *       data?: array<string,mixed>|null,
     *       email?: string|null,
     *       listID?: string|null,
     *       locale?: string|null,
     *       phoneNumber?: string|null,
     *       preferences?: array<mixed>|null,
     *       tenantID?: string|null,
     *       userID?: string|null,
     *     }|UserRecipient|list<array<mixed>>|null,
     *   },
     * }|SendMessageParams $params
     *
     * @return BaseResponse<SendMessageResponse>
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        ?RequestOptions $requestOptions = null
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
