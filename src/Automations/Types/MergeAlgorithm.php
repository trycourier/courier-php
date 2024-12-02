<?php

namespace Courier\Automations\Types;

enum MergeAlgorithm: string
{
    case Replace = "replace";
    case None = "none";
    case Overwrite = "overwrite";
    case SoftMerge = "soft-merge";
}
