<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Classes;

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
        foreach($this->getRequiredModules() as $module){
            $this->installModule($module);
        }
        return $this;
    }

    public function installModule(string $module_class): ApplicationInterface
    {
        /** @var ModuleInterface $module */
        $module = new $module_class();
        $module->install($this);
        $this->addInstalledModule($module_class);
        return $this;
    }
}