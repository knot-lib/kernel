<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Exception\KnotPhpException;
use KnotLib\Kernel\Kernel\AbstractApplication;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Kernel\ApplicationType;

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

    public function installModules(array $modules): ApplicationInterface
    {
        foreach($modules as $m){
            $this->addInstalledModule($m);
        }
        return $this;
    }
}