<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Classes\Logger;

use KnotLib\Kernel\Logger\EchoLogger;
use KnotLib\Kernel\Logger\LoggerInterface;
use KnotLib\Kernel\Logger\LoggerTrait;

final class LoggerTraitClass
{
    use LoggerTrait {
        emergency as public;
        critical as public;
        alert as public;
        error as public;
        warning as public;
        notice as public;
        info as public;
        debug as public;
    }

    /** @var EchoLogger */
    private $logger;

    /**
     * LoggerTraitClass constructor.
     */
    public function __construct()
    {
        $this->logger = new EchoLogger();
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return string
     */
    public function getChannelId(): string
    {
        return 'channel';
    }
}