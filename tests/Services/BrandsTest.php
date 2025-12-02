<?php

namespace Tests\Services;

use Courier\Brands\Brand;
use Courier\Brands\BrandListResponse;
use Courier\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BrandsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->create(['name' => 'name']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Brand::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->create([
            'name' => 'name',
            'id' => 'id',
            'settings' => [
                'colors' => ['primary' => 'primary', 'secondary' => 'secondary'],
                'email' => [
                    'footer' => ['content' => 'content', 'inheritDefault' => true],
                    'head' => ['inheritDefault' => true, 'content' => 'content'],
                    'header' => [
                        'logo' => ['href' => 'href', 'image' => 'image'],
                        'barColor' => 'barColor',
                        'inheritDefault' => true,
                    ],
                    'templateOverride' => [
                        'enabled' => true,
                        'backgroundColor' => 'backgroundColor',
                        'blocksBackgroundColor' => 'blocksBackgroundColor',
                        'footer' => 'footer',
                        'head' => 'head',
                        'header' => 'header',
                        'width' => 'width',
                        'mjml' => [
                            'enabled' => true,
                            'backgroundColor' => 'backgroundColor',
                            'blocksBackgroundColor' => 'blocksBackgroundColor',
                            'footer' => 'footer',
                            'head' => 'head',
                            'header' => 'header',
                            'width' => 'width',
                        ],
                        'footerBackgroundColor' => 'footerBackgroundColor',
                        'footerFullWidth' => true,
                    ],
                ],
                'inapp' => [
                    'colors' => ['primary' => 'primary', 'secondary' => 'secondary'],
                    'icons' => ['bell' => 'bell', 'message' => 'message'],
                    'widgetBackground' => [
                        'bottomColor' => 'bottomColor', 'topColor' => 'topColor',
                    ],
                    'borderRadius' => 'borderRadius',
                    'disableMessageIcon' => true,
                    'fontFamily' => 'fontFamily',
                    'placement' => 'top',
                ],
            ],
            'snippets' => ['items' => [['name' => 'name', 'value' => 'value']]],
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Brand::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->retrieve('brand_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Brand::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->update('brand_id', ['name' => 'name']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Brand::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->update(
            'brand_id',
            [
                'name' => 'name',
                'settings' => [
                    'colors' => ['primary' => 'primary', 'secondary' => 'secondary'],
                    'email' => [
                        'footer' => ['content' => 'content', 'inheritDefault' => true],
                        'head' => ['inheritDefault' => true, 'content' => 'content'],
                        'header' => [
                            'logo' => ['href' => 'href', 'image' => 'image'],
                            'barColor' => 'barColor',
                            'inheritDefault' => true,
                        ],
                        'templateOverride' => [
                            'enabled' => true,
                            'backgroundColor' => 'backgroundColor',
                            'blocksBackgroundColor' => 'blocksBackgroundColor',
                            'footer' => 'footer',
                            'head' => 'head',
                            'header' => 'header',
                            'width' => 'width',
                            'mjml' => [
                                'enabled' => true,
                                'backgroundColor' => 'backgroundColor',
                                'blocksBackgroundColor' => 'blocksBackgroundColor',
                                'footer' => 'footer',
                                'head' => 'head',
                                'header' => 'header',
                                'width' => 'width',
                            ],
                            'footerBackgroundColor' => 'footerBackgroundColor',
                            'footerFullWidth' => true,
                        ],
                    ],
                    'inapp' => [
                        'colors' => ['primary' => 'primary', 'secondary' => 'secondary'],
                        'icons' => ['bell' => 'bell', 'message' => 'message'],
                        'widgetBackground' => [
                            'bottomColor' => 'bottomColor', 'topColor' => 'topColor',
                        ],
                        'borderRadius' => 'borderRadius',
                        'disableMessageIcon' => true,
                        'fontFamily' => 'fontFamily',
                        'placement' => 'top',
                    ],
                ],
                'snippets' => ['items' => [['name' => 'name', 'value' => 'value']]],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Brand::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->brands->delete('brand_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
