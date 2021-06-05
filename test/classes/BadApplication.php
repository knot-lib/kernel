<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\exception\KnotPhpException;
use knotlib\kernel\kernel\AbstractApplication;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\kernel\ApplicationType;

final class BadApplication extends AbstractApplication
{
    public static function type(): ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }

    /**
     * @return ApplicationInterface
     * @throws KnotPhpException
     */
    public function install(): ApplicationInterface
    {
        throw new KnotPhpException('something is wrong.');
        /** @noinspection PhpUnreachableStatementInspection */
        return $this;
    }

    public function installModule(string $module_class): ApplicationInterface
    {
        $this->addInstalledModule($module_class);
        return $this;
    }
}