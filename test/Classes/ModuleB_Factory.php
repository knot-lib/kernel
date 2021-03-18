<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Classes;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Module\ModuleFactoryInterface;

final class ModuleB_Factory implements ModuleFactoryInterface
{
    public function createModule(string $module_class, ApplicationInterface $app)
    {
        if ($module_class === ModuleB::class){
            return new ModuleB(10000);
        }
        return null;
    }

}