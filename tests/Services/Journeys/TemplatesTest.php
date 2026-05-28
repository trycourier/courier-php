<?php

namespace Tests\Services\Journeys;

use Courier\Client;
use Courier\Core\Util;
use Courier\Journeys\JourneyTemplateGetResponse;
use Courier\Journeys\JourneyTemplateListResponse;
use Courier\Notifications\NotificationTemplateVersionListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TemplatesTest extends TestCase
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

        $result = $this->client->journeys->templates->create(
            'x',
            channel: 'email',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => ['elements' => [[]], 'version' => '2022-01-01'],
                'name' => 'Welcome email',
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['string'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->create(
            'x',
            channel: 'email',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => [
                    'elements' => [
                        [
                            'channels' => ['string'],
                            'if' => 'if',
                            'loop' => 'loop',
                            'ref' => 'ref',
                            'type' => 'text',
                        ],
                    ],
                    'version' => '2022-01-01',
                    'scope' => 'default',
                ],
                'name' => 'Welcome email',
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['string'],
            ],
            providerKey: 'x',
            state: 'state',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->retrieve(
            'x',
            templateID: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->retrieve(
            'x',
            templateID: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->list('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->archive('x', templateID: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testArchiveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->archive('x', templateID: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListVersions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->listVersions(
            'x',
            templateID: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NotificationTemplateVersionListResponse::class,
            $result
        );
    }

    #[Test]
    public function testListVersionsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->listVersions(
            'x',
            templateID: 'x'
        );

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

        $result = $this->client->journeys->templates->publish('x', templateID: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testPublishWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->publish(
            'x',
            templateID: 'x',
            version: 'v321669910225'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testReplace(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->replace(
            'x',
            templateID: 'x',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => ['elements' => [[]], 'version' => '2022-01-01'],
                'name' => 'name',
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['string'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->templates->replace(
            'x',
            templateID: 'x',
            notification: [
                'brand' => ['id' => 'id'],
                'content' => [
                    'elements' => [
                        [
                            'channels' => ['string'],
                            'if' => 'if',
                            'loop' => 'loop',
                            'ref' => 'ref',
                            'type' => 'text',
                        ],
                    ],
                    'version' => '2022-01-01',
                    'scope' => 'default',
                ],
                'name' => 'name',
                'subscription' => ['topicID' => 'topic_id'],
                'tags' => ['string'],
            ],
            state: 'state',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyTemplateGetResponse::class, $result);
    }
}
