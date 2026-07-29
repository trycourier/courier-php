<?php

namespace Tests\Services;

use Courier\Broadcasts\Broadcast;
use Courier\Broadcasts\BroadcastListResponse;
use Courier\Client;
use Courier\Core\Util;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BroadcastsTest extends TestCase
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

        $result = $this->client->broadcasts->create(
            channel: 'email',
            name: 'Spring Sale Announcement'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->create(
            channel: 'email',
            name: 'Spring Sale Announcement'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->retrieve('broadcastId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->update(
            'broadcastId',
            name: 'Spring Sale Announcement (v2)'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->update(
            'broadcastId',
            name: 'Spring Sale Announcement (v2)'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BroadcastListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->archive('broadcastId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->cancel('broadcastId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testDuplicate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->duplicate('broadcastId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testPutContent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->putContent(
            'broadcastId',
            content: ['elements' => [[], []]]
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

        $result = $this->client->broadcasts->putContent(
            'broadcastId',
            content: [
                'elements' => [
                    [
                        'channels' => ['string'],
                        'if' => 'if',
                        'loop' => 'loop',
                        'ref' => 'ref',
                        'type' => 'meta',
                    ],
                    [
                        'channels' => ['string'],
                        'if' => 'if',
                        'loop' => 'loop',
                        'ref' => 'ref',
                        'type' => 'text',
                    ],
                ],
                'version' => '2022-01-01',
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
    public function testRetrieveContent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->retrieveContent('broadcastId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NotificationContentGetResponse::class, $result);
    }

    #[Test]
    public function testSchedule(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->schedule(
            'broadcastId',
            recipientID: 'aud_01kx4h2jdafq8bk9amzvy6hbv0',
            recipientType: 'audience',
            scheduledTo: '2026-08-01T15:00:00',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testScheduleWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->schedule(
            'broadcastId',
            recipientID: 'aud_01kx4h2jdafq8bk9amzvy6hbv0',
            recipientType: 'audience',
            scheduledTo: '2026-08-01T15:00:00',
            timezone: 'America/New_York',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testSend(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->send(
            'broadcastId',
            recipientID: 'cool-customers',
            recipientType: 'list'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }

    #[Test]
    public function testSendWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->broadcasts->send(
            'broadcastId',
            recipientID: 'cool-customers',
            recipientType: 'list'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Broadcast::class, $result);
    }
}
