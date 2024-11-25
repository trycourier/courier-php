<?php

namespace Courier\Send\Types;

enum TextStyle: string
{
    case Text = "text";
    case H1 = "h1";
    case H2 = "h2";
    case Subtext = "subtext";
}
