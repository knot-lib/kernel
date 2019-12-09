<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class EchoLogger extends AbstractLogger implements LoggerInterface
{
    private $enabled;

    /**
     * EchoLogger constructor.
     *
     * @param bool $enabled
     */
    public function __construct(bool $enabled = true)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get channel logger
     *
     * @param string $channel_id
     *
     * @return LoggerChannelInterface
     */
    public function channel(string $channel_id): LoggerChannelInterface
    {
        return new EchoChannelLogger($this->enabled);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        if (!$this->enabled){
            return;
        }
        $levels = [
            LogLevel::EMERGENCY => 'E',
            LogLevel::CRITICAL => 'C',
            LogLevel::ALERT => 'A',
            LogLevel::ERROR => 'E',
            LogLevel::WARNING => 'W',
            LogLevel::NOTICE => 'N',
            LogLevel::INFO => 'I',
            LogLevel::DEBUG => 'D',
        ];
        echo '[' . $levels[$level] . ']' . $message . ' ' . json_encode($context) . PHP_EOL;
    }
}