<?php

namespace Tests\Services\Tenants;

use Courier\Client;
use Courier\Core\Util;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\PostTenantTemplatePublishResponse;
use Courier\Tenants\PutTenantTemplateResponse;
use Courier\Tenants\Templates\TemplateListResponse;
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->retrieve(
            'template_id',
            tenantID: 'tenant_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BaseTemplateTenantAssociation::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->retrieve(
            'template_id',
            tenantID: 'tenant_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BaseTemplateTenantAssociation::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->list('tenant_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TemplateListResponse::class, $result);
    }

    #[Test]
    public function testPublish(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->publish(
            'template_id',
            tenantID: 'tenant_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PostTenantTemplatePublishResponse::class, $result);
    }

    #[Test]
    public function testPublishWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->publish(
            'template_id',
            tenantID: 'tenant_id',
            version: 'version'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PostTenantTemplatePublishResponse::class, $result);
    }

    #[Test]
    public function testReplace(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->replace(
            'template_id',
            tenantID: 'tenant_id',
            template: ['content' => ['elements' => [[]], 'version' => 'version']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PutTenantTemplateResponse::class, $result);
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->tenants->templates->replace(
            'template_id',
            tenantID: 'tenant_id',
            template: [
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
                    'version' => 'version',
                ],
                'channels' => [
                    'foo' => [
                        'brandID' => 'brand_id',
                        'if' => 'if',
                        'metadata' => [
                            'utm' => [
                                'campaign' => 'campaign',
                                'content' => 'content',
                                'medium' => 'medium',
                                'source' => 'source',
                                'term' => 'term',
                            ],
                        ],
                        'override' => ['foo' => 'bar'],
                        'providers' => ['string'],
                        'routingMethod' => 'all',
                        'timeouts' => ['channel' => 0, 'provider' => 0],
                    ],
                ],
                'providers' => [
                    'foo' => [
                        'if' => 'if',
                        'metadata' => [
                            'utm' => [
                                'campaign' => 'campaign',
                                'content' => 'content',
                                'medium' => 'medium',
                                'source' => 'source',
                                'term' => 'term',
                            ],
                        ],
                        'override' => ['foo' => 'bar'],
                        'timeouts' => 0,
                    ],
                ],
                'routing' => ['channels' => ['string'], 'method' => 'all'],
            ],
            published: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PutTenantTemplateResponse::class, $result);
    }
}
