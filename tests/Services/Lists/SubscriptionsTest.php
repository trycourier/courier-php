<?php

namespace Tests\Services\Lists;

use Courier\ChannelPreference;
use Courier\Client;
use Courier\Lists\Subscriptions\NotificationPreferenceDetails;
use Courier\Lists\Subscriptions\PutSubscriptionsRecipient;
use Courier\Lists\Subscriptions\RecipientPreferences;
use Courier\Rule;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\Users\Preferences\PreferenceStatus;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SubscriptionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->list('list_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            [PutSubscriptionsRecipient::with(recipientID: 'recipientId')]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            [
                PutSubscriptionsRecipient::with(recipientID: 'recipientId')
                    ->withPreferences(
                        (new RecipientPreferences)
                            ->withCategories(
                                [
                                    'foo' => NotificationPreferenceDetails::with(
                                        status: PreferenceStatus::OPTED_IN
                                    )
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')]),
                                ],
                            )
                            ->withNotifications(
                                [
                                    'foo' => NotificationPreferenceDetails::with(
                                        status: PreferenceStatus::OPTED_IN
                                    )
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')]),
                                ],
                            ),
                    ),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testSubscribe(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            [PutSubscriptionsRecipient::with(recipientID: 'recipientId')]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testSubscribeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            [
                PutSubscriptionsRecipient::with(recipientID: 'recipientId')
                    ->withPreferences(
                        (new RecipientPreferences)
                            ->withCategories(
                                [
                                    'foo' => NotificationPreferenceDetails::with(
                                        status: PreferenceStatus::OPTED_IN
                                    )
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')]),
                                ],
                            )
                            ->withNotifications(
                                [
                                    'foo' => NotificationPreferenceDetails::with(
                                        status: PreferenceStatus::OPTED_IN
                                    )
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')]),
                                ],
                            ),
                    ),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testSubscribeUser(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            listID: 'list_id'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testSubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            listID: 'list_id'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUnsubscribeUser(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            'list_id'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUnsubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            'list_id'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
