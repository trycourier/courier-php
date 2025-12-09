<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

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
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface BrandsContract
{
    /**
     * @api
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
    ): Brand;

    /**
     * @api
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @api
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
    ): Brand;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse;

    /**
     * @api
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
