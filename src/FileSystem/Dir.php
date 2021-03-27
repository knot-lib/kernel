<?php
declare(strict_types=1);

namespace KnotLib\Kernel\FileSystem;

class Dir
{
    const TMP          = 1;
    const CACHE        = 2;
    const LOGS         = 3;
    const DATA         = 4;
    const SRC          = 5;
    const INCLUDE      = 6;
    const CONFIG       = 7;
    const TEMPLATE     = 8;
    const BIN          = 9;
    const COMMAND      = 10;
    const WEBROOT      = 11;
    const PLUGIN       = 12;

    const USER_DIR_BASE    = 100;

    /**
     * Returns string expression of directory id
     *
     * @param int $dir
     *
     * @return string
     */
    public static function toString(int $dir) : string
    {
        $map = [
            self::TMP => 'TMP',
            self::CACHE => 'CACHE',
            self::LOGS => 'LOGS',
            self::DATA => 'DATA',
            self::SRC => 'SRC',
            self::INCLUDE => 'INCLUDE',
            self::CONFIG => 'CONFIG',
            self::TEMPLATE => 'TEMPLATE',
            self::BIN => 'BIN',
            self::COMMAND => 'COMMAND',
            self::WEBROOT => 'WEBROOT',
            self::PLUGIN => 'PLUGIN',
        ];
        return $map[$dir] ?? '';
    }
}