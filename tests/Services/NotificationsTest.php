<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Core\Util;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationListResponse;
use Courier\Notifications\NotificationTemplateGetResponse;
use Courier\Notifications\NotificationTemplateMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class NotificationsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->create(
            notification: [
                'brand' => ['id' => 'brand_abc'],
                'content' => ['elements' => [[]], 'version' => '2022-01-01'],
                'name' => 'Welcome Email',
                'routing' => ['strategyID' => 'rs_123'],
                'subscription' => ['topicID' => 'marketing'],
                'tags' => ['onboarding', 'welcome'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->create(
            notification: [
                'brand' => ['id' => 'brand_abc'],
                'content' => [
                    'elements' => [['type' => 'channel']], 'version' => '2022-01-01',
                ],
                'name' => 'Welcome Email',
                'routing' => ['strategyID' => 'rs_123'],
                'subscription' => ['topicID' => 'marketing'],
                'tags' => ['onboarding', 'welcome'],
            ],
            state: 'DRAFT',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NotificationTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NotificationListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->archive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListVersions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->listVersions('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateVersionListResponse::class,
            $result
        );
    }

    #[Test]
    public function testPublish(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->publish('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testPutContent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putContent(
            'id',
            content: ['elements' => [[]]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testPutContentWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putContent(
            'id',
            content: [
                'elements' => [['type' => 'channel']], 'version' => '2022-01-01',
            ],
            state: NotificationTemplateState::DRAFT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testPutElement(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putElement(
            'elementId',
            id: 'id',
            type: 'text'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testPutElementWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putElement(
            'elementId',
            id: 'id',
            type: 'text',
            channels: ['string'],
            data: ['content' => 'bar'],
            if: 'if',
            loop: 'loop',
            ref: 'ref',
            state: NotificationTemplateState::DRAFT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testPutLocale(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putLocale(
            'localeId',
            id: 'id',
            elements: [['id' => 'elem_1'], ['id' => 'elem_2']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testPutLocaleWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->putLocale(
            'localeId',
            id: 'id',
            elements: [['id' => 'elem_1'], ['id' => 'elem_2']],
            state: NotificationTemplateState::DRAFT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationContentMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testReplace(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->replace(
            'id',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => ['elements' => [[]], 'version' => '2022-01-01'],
                'name' => 'Updated Name',
                'routing' => ['strategyID' => 'strategy_id'],
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['updated'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->replace(
            'id',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => [
                    'elements' => [['type' => 'channel']], 'version' => '2022-01-01',
                ],
                'name' => 'Updated Name',
                'routing' => ['strategyID' => 'strategy_id'],
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['updated'],
            ],
            state: 'PUBLISHED',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateMutationResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrieveContent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->notifications->retrieveContent('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }
}
