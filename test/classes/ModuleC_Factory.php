<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\module\ModuleFactoryInterface;

final class ModuleC_Factory implements ModuleFactoryInterface
{
    public function createModule(string $module_class, ApplicationInterface $app)
    {
        if ($module_class === ModuleC::class){
            return new ModuleC('David');
        }
        return null;
    }

}