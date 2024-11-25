<?php

namespace Courier\Send\Types;

enum RuleType: string
{
    case Snooze = "snooze";
    case ChannelPreferences = "channel_preferences";
    case Status = "status";
}
