<?php

namespace Tests\Services\Profiles;

use Courier\Client;
use Courier\ChannelPreference;
use Courier\Rule;
use Courier\Lists\Subscriptions\RecipientPreferences;
use Courier\Lists\Subscriptions\NotificationPreferenceDetails;
use Courier\Profiles\Lists\ListSubscribeParams\List;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\Users\Preferences\PreferenceStatus;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnsupportedMockTests;

#[CoversNothing]
final class ListsTest extends TestCase
{
  protected Client $client;

  /**  */
  protected function setUp(): void {
    parent::setUp();

    $testUrl = getenv("TEST_API_BASE_URL") ?: "http://127.0.0.1:4010";
    $client = new Client(apiKey: "My API Key", baseUrl: $testUrl);

    $this->client = $client;
  }

  /**  */
  #[Test]
  public function testRetrieve(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped("Prism tests are disabled");
    }

    $result = $this->client->profiles->lists->retrieve("user_id");

    $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
  }

  /**  */
  #[Test]
  public function testDelete(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped("Prism tests are disabled");
    }

    $result = $this->client->profiles->lists->delete("user_id");

    $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
  }

  /**  */
  #[Test]
  public function testSubscribe(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped("Prism tests are disabled");
    }

    $result = $this->client->profiles->lists->subscribe(
      "user_id", [List::with(listID: "listId")]
    );

    $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
  }

  /**  */
  #[Test]
  function testSubscribeWithOptionalParams(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped("Prism tests are disabled");
    }

    $result = $this->client->profiles->lists->subscribe(
      "user_id",
      [
        List::with(listID: "listId")
          ->withPreferences(
          (new RecipientPreferences)
            ->withCategories(
            [
              "foo" => NotificationPreferenceDetails::with(
                status: PreferenceStatus::$OPTED_IN
              )
                ->withChannelPreferences(
                [
                  ChannelPreference::with(
                    channel: ChannelClassification::$DIRECT_MESSAGE
                  ),
                ],
              )
                ->withRules([Rule::with(until: "until")->withStart("start")]),
            ],
          )
            ->withNotifications(
            [
              "foo" => NotificationPreferenceDetails::with(
                status: PreferenceStatus::$OPTED_IN
              )
                ->withChannelPreferences(
                [
                  ChannelPreference::with(
                    channel: ChannelClassification::$DIRECT_MESSAGE
                  ),
                ],
              )
                ->withRules([Rule::with(until: "until")->withStart("start")]),
            ],
          ),
        ),
      ],
    );

    $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
  }
}