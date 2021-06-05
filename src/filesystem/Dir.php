<?php
declare(strict_types=1);

namespace knotlib\kernel\filesystem;

class Dir
{
    const FRAMEWORK     = 'knot.framework';

    const TMP          = self::FRAMEWORK . '.tmp';
    const CACHE        = self::FRAMEWORK . '.cache';
    const LOGS         = self::FRAMEWORK . '.logs';
    const DATA         = self::FRAMEWORK . '.data';
    const SRC          = self::FRAMEWORK . '.src';
    const INCLUDE      = self::FRAMEWORK . '.include';
    const CONFIG       = self::FRAMEWORK . '.config';
    const TEMPLATE     = self::FRAMEWORK . '.template';
    const BIN          = self::FRAMEWORK . '.bin';
    const COMMAND      = self::FRAMEWORK . '.command';
    const WEBROOT      = self::FRAMEWORK . '.webroot';
}