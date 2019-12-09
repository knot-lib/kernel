<?php
namespace KnotLib\Kernel\NullObject;

use Psr\Log\NullLogger as PsrNullLogger;

use KnotLib\Kernel\Logger\LoggerInterface;
use KnotLib\Kernel\Logger\LoggerChannelInterface;

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