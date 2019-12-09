<?php
namespace KnotLib\Kernel\EventStream;

final class Channels
{
    private const PREFIX      = 'calgamo.kernel.';

    const SYSTEM      = self::PREFIX . 'system';
    const USER        = self::PREFIX . 'user';
}