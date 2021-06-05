<?php
declare(strict_types=1);

namespace knotlib\kernel\eventstream;

final class Channels
{
    private const PREFIX      = 'calgamo.kernel.';

    const SYSTEM      = self::PREFIX . 'system';
    const USER        = self::PREFIX . 'user';
}