<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\MessageContext;
use Courier\MessageRoutingChannel;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageResponse;
use Courier\ServiceContracts\SendContract;
use Courier\UserRecipient;

final class SendService implements SendContract
{
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
     *     brand_id?: string|null,
     *     channels?: array<string,array{
     *       brand_id?: string|null,
     *       if?: string|null,
     *       metadata?: array<mixed>|null,
     *       override?: array<string,mixed>|null,
     *       providers?: list<string>|null,
     *       routing_method?: 'all'|'single'|null,
     *       timeouts?: array<mixed>|null,
     *     }>|null,
     *     content?: array<string,mixed>,
     *     context?: array{tenant_id?: string|null}|MessageContext|null,
     *     data?: array<string,mixed>|null,
     *     delay?: array{duration?: int|null, until?: string|null}|null,
     *     expiry?: array{expires_in: string|int, expires_at?: string|null}|null,
     *     metadata?: array{
     *       event?: string|null,
     *       tags?: list<string>|null,
     *       trace_id?: string|null,
     *       utm?: array{
     *         campaign?: string|null,
     *         content?: string|null,
     *         medium?: string|null,
     *         source?: string|null,
     *         term?: string|null,
     *       }|null,
     *     }|null,
     *     preferences?: array{subscription_topic_id: string}|null,
     *     providers?: array<string,array{
     *       if?: string|null,
     *       metadata?: array<mixed>|null,
     *       override?: array<string,mixed>|null,
     *       timeouts?: int|null,
     *     }>|null,
     *     routing?: array{
     *       channels: list<mixed|string|MessageRoutingChannel>, method: 'all'|'single'
     *     }|null,
     *     template?: string|null,
     *     timeout?: array{
     *       channel?: array<string,int>|null,
     *       criteria?: 'no-escalation'|'delivered'|'viewed'|'engaged'|null,
     *       escalation?: int|null,
     *       message?: int|null,
     *       provider?: array<string,int>|null,
     *     }|null,
     *     to?: array{
     *       account_id?: string|null,
     *       context?: array<mixed>|MessageContext|null,
     *       data?: array<string,mixed>|null,
     *       email?: string|null,
     *       list_id?: string|null,
     *       locale?: string|null,
     *       phone_number?: string|null,
     *       preferences?: array<mixed>|null,
     *       tenant_id?: string|null,
     *       user_id?: string|null,
     *     }|UserRecipient|list<array<mixed>>|null,
     *   },
     * }|SendMessageParams $params
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse {
        [$parsed, $options] = SendMessageParams::parseRequest(
            $params,
            $requestOptions,
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
