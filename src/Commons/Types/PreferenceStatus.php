<?php

namespace Courier\Commons\Types;

enum PreferenceStatus: string
{
    case OptedIn = "OPTED_IN";
    case OptedOut = "OPTED_OUT";
    case Required = "REQUIRED";
}
