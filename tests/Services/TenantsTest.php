<?php

namespace Tests\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Util;
use Courier\Tenants\Tenant;
use Courier\Tenants\TenantListResponse;
use Courier\Tenants\TenantListUsersResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TenantsTest extends TestCase
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->retrieve('tenant_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Tenant::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->update('tenant_id', name: 'name');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Tenant::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->update(
            'tenant_id',
            name: 'name',
            brandID: 'brand_id',
            defaultPreferences: [
                'items' => [
                    [
                        'status' => 'OPTED_OUT',
                        'customRouting' => [ChannelClassification::DIRECT_MESSAGE],
                        'hasCustomRouting' => true,
                        'id' => 'id',
                    ],
                ],
            ],
            parentTenantID: 'parent_tenant_id',
            properties: ['foo' => 'bar'],
            userProfile: ['foo' => 'bar'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Tenant::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TenantListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->delete('tenant_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->tenants->listUsers('tenant_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TenantListUsersResponse::class, $result);
    }
}
