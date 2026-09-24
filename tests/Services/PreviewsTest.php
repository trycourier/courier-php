<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Core\Util;
use Courier\Previews\DeviceSet;
use Courier\Previews\DeviceSetListResponse;
use Courier\Previews\PreviewDeviceListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PreviewsTest extends TestCase
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
    public function testArchiveDeviceSet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->archiveDeviceSet('deviceSetId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }

    #[Test]
    public function testCreateDeviceSet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->createDeviceSet(
            deviceIDs: ['pvd_1w6dgafr3aaycvv9a8bm996pkc'],
            name: 'Mobile'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }

    #[Test]
    public function testCreateDeviceSetWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->createDeviceSet(
            deviceIDs: ['pvd_1w6dgafr3aaycvv9a8bm996pkc'],
            name: 'Mobile'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }

    #[Test]
    public function testListDeviceSets(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->listDeviceSets();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSetListResponse::class, $result);
    }

    #[Test]
    public function testListDevices(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->listDevices();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PreviewDeviceListResponse::class, $result);
    }

    #[Test]
    public function testRetrieveDeviceSet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->retrieveDeviceSet('deviceSetId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }

    #[Test]
    public function testUpdateDeviceSet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->updateDeviceSet(
            'deviceSetId',
            deviceIDs: [
                'pvd_1w6dgafr3aaycvv9a8bm996pkc', 'pvd_34qvmj6p4dbqaa5mpys1ekt9jx',
            ],
            name: 'Mobile and desktop',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }

    #[Test]
    public function testUpdateDeviceSetWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->previews->updateDeviceSet(
            'deviceSetId',
            deviceIDs: [
                'pvd_1w6dgafr3aaycvv9a8bm996pkc', 'pvd_34qvmj6p4dbqaa5mpys1ekt9jx',
            ],
            name: 'Mobile and desktop',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceSet::class, $result);
    }
}
