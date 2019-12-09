<?php
namespace KnotLib\Kernel\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

interface LoggerInterface extends PsrLoggerInterface
{
    /**
     * Get channel logger
     *
     * @param string $channel_id
     *
     * @return LoggerChannelInterface
     */
    public function channel(string $channel_id) : LoggerChannelInterface;
}