<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use Psr\Log\NullLogger as PsrNullLogger;

use knotlib\kernel\logger\LoggerInterface;
use knotlib\kernel\logger\LoggerChannelInterface;

final class NullLogger extends PsrNullLogger implements LoggerInterface
{
    /**
     * Get channel logger
     *
     * @param string $channel_id
     *
     * @return LoggerChannelInterface
     */
    public function channel(string $channel_id) : LoggerChannelInterface
    {
        return new NullLoggerChannel;
    }
}