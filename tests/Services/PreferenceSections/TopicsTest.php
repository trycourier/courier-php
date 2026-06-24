<?php

namespace Tests\Services\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Util;
use Courier\PreferenceSections\PreferenceTopicGetResponse;
use Courier\PreferenceSections\PreferenceTopicListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TopicsTest extends TestCase
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

        $result = $this->client->preferenceSections->topics->create(
            'section_id',
            defaultStatus: 'OPTED_OUT',
            name: 'Marketing'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->create(
            'section_id',
            defaultStatus: 'OPTED_OUT',
            name: 'Marketing',
            allowedPreferences: ['snooze'],
            includeUnsubscribeHeader: true,
            routingOptions: [ChannelClassification::DIRECT_MESSAGE],
            topicData: ['foo' => 'bar'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->retrieve(
            'topic_id',
            sectionID: 'section_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->retrieve(
            'topic_id',
            sectionID: 'section_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->list('section_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->archive(
            'topic_id',
            sectionID: 'section_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testArchiveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->archive(
            'topic_id',
            sectionID: 'section_id'
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

        $result = $this->client->preferenceSections->topics->replace(
            'topic_id',
            sectionID: 'section_id',
            defaultStatus: 'OPTED_OUT',
            name: 'name',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->preferenceSections->topics->replace(
            'topic_id',
            sectionID: 'section_id',
            defaultStatus: 'OPTED_OUT',
            name: 'name',
            allowedPreferences: ['snooze'],
            includeUnsubscribeHeader: true,
            routingOptions: [ChannelClassification::DIRECT_MESSAGE],
            topicData: ['foo' => 'bar'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreferenceTopicGetResponse::class, $result);
    }
}
