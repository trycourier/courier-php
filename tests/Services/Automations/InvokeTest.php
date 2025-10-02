<?php

namespace Tests\Services\Automations;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToDigestStep;
use Courier\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class InvokeTest extends TestCase
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
    public function testInvokeAdHoc(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeAdHoc(
            automation: Automation::with(
                steps: [
                    AutomationAddToDigestStep::with(
                        action: 'add-to-digest',
                        subscriptionTopicID: 'RAJE97CMT04KDJJ88ZDS2TP1690S',
                    ),
                ],
            ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeAdHocWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeAdHoc(
            automation: Automation::with(
                steps: [
                    AutomationAddToDigestStep::with(
                        action: 'add-to-digest',
                        subscriptionTopicID: 'RAJE97CMT04KDJJ88ZDS2TP1690S',
                    )
                        ->withIf('if')
                        ->withRef('ref'),
                ],
            )
                ->withCancelationToken('cancelation_token'),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeByTemplate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeByTemplate(
            'templateId'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
