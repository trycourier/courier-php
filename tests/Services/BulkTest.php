<?php

namespace Tests\Services;

use Courier\ChannelClassification;
use Courier\ChannelPreference;
use Courier\Client;
use Courier\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\InboundBulkMessageUser;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\Preference;
use Courier\PreferenceStatus;
use Courier\RecipientPreferences;
use Courier\Rule;
use Courier\UserRecipient;
use Courier\UserRecipient\Preferences;
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
                                        'foo' => Preference::with(status: PreferenceStatus::OPTED_IN)
                                            ->withChannelPreferences(
                                                [
                                                    ChannelPreference::with(
                                                        channel: ChannelClassification::DIRECT_MESSAGE
                                                    ),
                                                ],
                                            )
                                            ->withRules([Rule::with(until: 'until')->withStart('start')])
                                            ->withSource('subscription'),
                                    ],
                                )
                                    ->withCategories(
                                        [
                                            'foo' => Preference::with(status: PreferenceStatus::OPTED_IN)
                                                ->withChannelPreferences(
                                                    [
                                                        ChannelPreference::with(
                                                            channel: ChannelClassification::DIRECT_MESSAGE
                                                        ),
                                                    ],
                                                )
                                                ->withRules([Rule::with(until: 'until')->withStart('start')])
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
