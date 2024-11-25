<?php

namespace Courier\Users\Tokens\Types;

enum PatchOp: string
{
    case Replace = "replace";
    case Add = "add";
    case Remove = "remove";
    case Copy = "copy";
    case Move = "move";
    case Test = "test";
}
