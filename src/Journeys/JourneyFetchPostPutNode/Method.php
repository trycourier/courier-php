<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyFetchPostPutNode;

enum Method: string
{
    case POST = 'post';

    case PUT = 'put';
}
