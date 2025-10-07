<?php

namespace Tests\Services;

use Courier\Bulk\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\Bulk\UserRecipient;
use Courier\Bulk\UserRecipient\Preferences;
use Courier\Client;
use Courier\Lists\Subscriptions\RecipientPreferences;
use Courier\Lists\Subscriptions\RecipientPreferences\Category;
use Courier\Lists\Subscriptions\RecipientPreferences\Category\ChannelPreference;
use Courier\Lists\Subscriptions\RecipientPreferences\Category\Rule;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification;
use Courier\Send\MessageContext;
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
final class BulkTest extends TestCase
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
    public function testAddUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->addUsers(
            'job_id',
            [new InboundBulkMessageUser]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAddUsersWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->addUsers(
            'job_id',
            [
                (new InboundBulkMessageUser)
                    ->withData((object) [])
                    ->withPreferences(
                        (new RecipientPreferences)
                            ->withCategories(
                                [
                                    'foo' => Category::with(status: PreferenceStatus::OPTED_IN)
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
                                    'foo' => Notification::with(status: PreferenceStatus::OPTED_IN)
                                        ->withChannelPreferences(
                                            [
                                                Courier\Lists\Subscriptions\RecipientPreferences\Notification\ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules(
                                            [
                                                Courier\Lists\Subscriptions\RecipientPreferences\Notification\Rule::with(
                                                    until: 'until'
                                                )
                                                    ->withStart('start'),
                                            ],
                                        ),
                                ],
                            ),
                    )
                    ->withProfile((object) [])
                    ->withRecipient('recipient')
                    ->withTo(
                        (new UserRecipient)
                            ->withAccountID('account_id')
                            ->withContext((new MessageContext)->withTenantID('tenant_id'))
                            ->withData(['foo' => 'bar'])
                            ->withEmail('email')
                            ->withLocale('locale')
                            ->withPhoneNumber('phone_number')
                            ->withPreferences(
                                Preferences::with(
                                    notifications: [
                                        'foo' => Courier\Bulk\UserRecipient\Preferences\Notification::with(
                                            status: PreferenceStatus::OPTED_IN
                                        )
                                            ->withChannelPreferences(
                                                [
                                                    Courier\Bulk\UserRecipient\Preferences\Notification\ChannelPreference::with(
                                                        channel: ChannelClassification::DIRECT_MESSAGE
                                                    ),
                                                ],
                                            )
                                            ->withRules(
                                                [
                                                    Courier\Bulk\UserRecipient\Preferences\Notification\Rule::with(
                                                        until: 'until'
                                                    )
                                                        ->withStart('start'),
                                                ],
                                            )
                                            ->withSource('subscription'),
                                    ],
                                )
                                    ->withCategories(
                                        [
                                            'foo' => Courier\Bulk\UserRecipient\Preferences\Category::with(
                                                status: PreferenceStatus::OPTED_IN
                                            )
                                                ->withChannelPreferences(
                                                    [
                                                        Courier\Bulk\UserRecipient\Preferences\Category\ChannelPreference::with(
                                                            channel: ChannelClassification::DIRECT_MESSAGE
                                                        ),
                                                    ],
                                                )
                                                ->withRules(
                                                    [
                                                        Courier\Bulk\UserRecipient\Preferences\Category\Rule::with(
                                                            until: 'until'
                                                        )
                                                            ->withStart('start'),
                                                    ],
                                                )
                                                ->withSource('subscription'),
                                        ],
                                    )
                                    ->withTemplateID('templateId'),
                            )
                            ->withTenantID('tenant_id')
                            ->withUserID('user_id'),
                    ),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob(
            InboundBulkTemplateMessage::with(template: 'template')
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateJobWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob(
            InboundBulkTemplateMessage::with(template: 'template')
                ->withBrand('brand')
                ->withData(['foo' => 'bar'])
                ->withEvent('event')
                ->withLocale(['foo' => ['foo' => 'bar']])
                ->withOverride(['foo' => 'bar']),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->listUsers('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieveJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->retrieveJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRunJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->runJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
