<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes\logger;

use knotlib\kernel\logger\EchoLogger;
use knotlib\kernel\logger\LoggerInterface;
use knotlib\kernel\logger\LoggerTrait;

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