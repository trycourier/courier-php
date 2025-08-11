<?php

namespace Courier\Messages\Types;

enum Reason: string
{
    case Bounced = "BOUNCED";
    case Failed = "FAILED";
    case Filtered = "FILTERED";
    case NoChannels = "NO_CHANNELS";
    case NoProviders = "NO_PROVIDERS";
    case OptInRequired = "OPT_IN_REQUIRED";
    case ProviderError = "PROVIDER_ERROR";
    case Unpublished = "UNPUBLISHED";
    case Unsubscribed = "UNSUBSCRIBED";
}
