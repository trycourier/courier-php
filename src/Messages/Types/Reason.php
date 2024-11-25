<?php

namespace Courier\Messages\Types;

enum Reason: string
{
    case Filtered = "FILTERED";
    case NoChannels = "NO_CHANNELS";
    case NoProviders = "NO_PROVIDERS";
    case ProviderError = "PROVIDER_ERROR";
    case Unpublished = "UNPUBLISHED";
    case Unsubscribed = "UNSUBSCRIBED";
}
