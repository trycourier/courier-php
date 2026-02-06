<?php

namespace Tests\Services\Users;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Util;
use Courier\PreferenceStatus;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PreferencesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->users->preferences->retrieve('user_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveTopic(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->users->preferences->retrieveTopic(
            'topic_id',
            userID: 'user_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceGetTopicResponse::class, $result);
    }

    #[Test]
    public function testRetrieveTopicWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->users->preferences->retrieveTopic(
            'topic_id',
            userID: 'user_id',
            tenantID: 'tenant_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceGetTopicResponse::class, $result);
    }

    #[Test]
    public function testUpdateOrCreateTopic(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->users->preferences->updateOrCreateTopic(
            'topic_id',
            userID: 'user_id',
            topic: ['status' => PreferenceStatus::OPTED_IN],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceUpdateOrNewTopicResponse::class, $result);
    }

    #[Test]
    public function testUpdateOrCreateTopicWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->users->preferences->updateOrCreateTopic(
            'topic_id',
            userID: 'user_id',
            topic: [
                'status' => PreferenceStatus::OPTED_IN,
                'customRouting' => [
                    ChannelClassification::INBOX, ChannelClassification::EMAIL,
                ],
                'hasCustomRouting' => true,
            ],
            tenantID: 'tenant_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceUpdateOrNewTopicResponse::class, $result);
    }
}
