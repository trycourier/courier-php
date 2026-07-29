<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\ChecksContract;

/**
 * Create, update, version, publish, and localize notification templates and their content.
 *
 * @phpstan-import-type BaseCheckShape from \Courier\Notifications\BaseCheck
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ChecksService implements ChecksContract
{
    /**
     * @api
     */
    public ChecksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChecksRawService($client);
    }

    /**
     * @api
     *
     * Replaces the approval checks on a template submission with the complete set supplied in the request body.
     *
     * @param string $submissionID path param: Submission ID
     * @param string $id path param: Notification template ID
     * @param list<BaseCheck|BaseCheckShape> $checks Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        string $id,
        array $checks,
        RequestOptions|array|null $requestOptions = null,
    ): CheckUpdateResponse {
        $params = Util::removeNulls(['id' => $id, 'checks' => $checks]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the approval checks recorded for a template submission, each with its pass or fail result.
     *
     * @param string $submissionID submission ID
     * @param string $id notification template ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): CheckListResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a pending template submission, withdrawing it from the approval workflow. The template stays in draft and can be resubmitted later.
     *
     * @param string $submissionID submission ID
     * @param string $id notification template ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
