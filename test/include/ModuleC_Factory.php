<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Module\ModuleFactoryInterface;

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