<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\module\ModuleFactoryInterface;

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