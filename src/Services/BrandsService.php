<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Brands\Brand;
use Courier\Brands\BrandColors;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSettingsEmail;
use Courier\Brands\BrandSettingsInApp;
use Courier\Brands\BrandSettingsInApp\Placement;
use Courier\Brands\BrandSnippet;
use Courier\Brands\BrandSnippets;
use Courier\Brands\BrandTemplate;
use Courier\Brands\EmailFooter;
use Courier\Brands\EmailHead;
use Courier\Brands\EmailHeader;
use Courier\Brands\Icons;
use Courier\Brands\Logo;
use Courier\Brands\WidgetBackground;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\BrandsContract;

final class BrandsService implements BrandsContract
{
    /**
     * @api
     */
    public BrandsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BrandsRawService($client);
    }

    /**
     * @api
     *
     * Create a new brand
     *
     * @param array{
     *   colors?: array{primary?: string, secondary?: string}|BrandColors|null,
     *   email?: array{
     *     footer?: array{
     *       content?: string|null, inheritDefault?: bool|null
     *     }|EmailFooter|null,
     *     head?: array{inheritDefault: bool, content?: string|null}|EmailHead|null,
     *     header?: array{
     *       logo: array{href?: string|null, image?: string|null}|Logo,
     *       barColor?: string|null,
     *       inheritDefault?: bool|null,
     *     }|EmailHeader|null,
     *     templateOverride?: array{
     *       enabled: bool,
     *       backgroundColor?: string|null,
     *       blocksBackgroundColor?: string|null,
     *       footer?: string|null,
     *       head?: string|null,
     *       header?: string|null,
     *       width?: string|null,
     *       mjml: array{
     *         enabled: bool,
     *         backgroundColor?: string|null,
     *         blocksBackgroundColor?: string|null,
     *         footer?: string|null,
     *         head?: string|null,
     *         header?: string|null,
     *         width?: string|null,
     *       }|BrandTemplate,
     *       footerBackgroundColor?: string|null,
     *       footerFullWidth?: bool|null,
     *     }|null,
     *   }|BrandSettingsEmail|null,
     *   inapp?: array{
     *     colors: array{primary?: string, secondary?: string}|BrandColors,
     *     icons: array{bell?: string|null, message?: string|null}|Icons,
     *     widgetBackground: array{
     *       bottomColor?: string|null, topColor?: string|null
     *     }|WidgetBackground,
     *     borderRadius?: string|null,
     *     disableMessageIcon?: bool|null,
     *     fontFamily?: string|null,
     *     placement?: 'top'|'bottom'|'left'|'right'|Placement|null,
     *   }|BrandSettingsInApp|null,
     * }|BrandSettings|null $settings
     * @param array{
     *   items?: list<array{name: string, value: string}|BrandSnippet>|null
     * }|BrandSnippets|null $snippets
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $id = null,
        array|BrandSettings|null $settings = null,
        array|BrandSnippets|null $snippets = null,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'id' => $id,
                'settings' => $settings,
                'snippets' => $snippets,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a specific brand by brand ID.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): Brand {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($brandID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace an existing brand with the supplied values.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to update
     * @param string $name the name of the brand
     * @param array{
     *   colors?: array{primary?: string, secondary?: string}|BrandColors|null,
     *   email?: array{
     *     footer?: array{
     *       content?: string|null, inheritDefault?: bool|null
     *     }|EmailFooter|null,
     *     head?: array{inheritDefault: bool, content?: string|null}|EmailHead|null,
     *     header?: array{
     *       logo: array{href?: string|null, image?: string|null}|Logo,
     *       barColor?: string|null,
     *       inheritDefault?: bool|null,
     *     }|EmailHeader|null,
     *     templateOverride?: array{
     *       enabled: bool,
     *       backgroundColor?: string|null,
     *       blocksBackgroundColor?: string|null,
     *       footer?: string|null,
     *       head?: string|null,
     *       header?: string|null,
     *       width?: string|null,
     *       mjml: array{
     *         enabled: bool,
     *         backgroundColor?: string|null,
     *         blocksBackgroundColor?: string|null,
     *         footer?: string|null,
     *         head?: string|null,
     *         header?: string|null,
     *         width?: string|null,
     *       }|BrandTemplate,
     *       footerBackgroundColor?: string|null,
     *       footerFullWidth?: bool|null,
     *     }|null,
     *   }|BrandSettingsEmail|null,
     *   inapp?: array{
     *     colors: array{primary?: string, secondary?: string}|BrandColors,
     *     icons: array{bell?: string|null, message?: string|null}|Icons,
     *     widgetBackground: array{
     *       bottomColor?: string|null, topColor?: string|null
     *     }|WidgetBackground,
     *     borderRadius?: string|null,
     *     disableMessageIcon?: bool|null,
     *     fontFamily?: string|null,
     *     placement?: 'top'|'bottom'|'left'|'right'|Placement|null,
     *   }|BrandSettingsInApp|null,
     * }|BrandSettings|null $settings
     * @param array{
     *   items?: list<array{name: string, value: string}|BrandSnippet>|null
     * }|BrandSnippets|null $snippets
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        string $name,
        array|BrandSettings|null $settings = null,
        array|BrandSnippets|null $snippets = null,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            ['name' => $name, 'settings' => $settings, 'snippets' => $snippets]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($brandID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the list of brands.
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a brand by brand ID.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($brandID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
