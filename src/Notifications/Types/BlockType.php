<?php

namespace Courier\Notifications\Types;

enum BlockType: string
{
    case Action = "action";
    case Divider = "divider";
    case Image = "image";
    case Jsonnet = "jsonnet";
    case List_ = "list";
    case Markdown = "markdown";
    case Quote = "quote";
    case Template = "template";
    case Text = "text";
}
