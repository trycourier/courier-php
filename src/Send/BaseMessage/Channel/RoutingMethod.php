<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Channel;

/**
 * The method for selecting the providers to send the message with.
 * Single will send to one of the available providers for this channel,
 * all will send the message through all channels. Defaults to `single`.
 */
enum RoutingMethod: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
