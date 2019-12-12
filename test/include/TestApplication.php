<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Kernel\AbstractApplication;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Kernel\ApplicationType;
use KnotLib\Kernel\Module\ModuleInterface;

final class TestApplication extends AbstractApplication
{
    public static function type(): ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }

    public function install(): ApplicationInterface
    {
        $this->installModules($this->getRequiredModules());
        return $this;
    }

    public function installModules(array $modules): ApplicationInterface
    {
        foreach($modules as $m){
            /** @var ModuleInterface $module */
            $module = new $m();
            $module->install($this);
            $this->addInstalledModule($m);
        }
        return $this;
    }
}