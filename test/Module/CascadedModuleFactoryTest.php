<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Module\CascadedModuleFactory;
use KnotLib\Kernel\Module\ModuleInterface;
use PHPUnit\Framework\TestCase;

final class CascadedModuleFactoryTest extends TestCase
{
    /**
     * @throws
     */
    public function testCreateModule()
    {
        $app = new TestApplication();
        $factory = new CascadedModuleFactory([
            new ModuleB_Factory(),
            new ModuleC_Factory()
        ]);

        $module = $factory->createModule(ModuleB::class, $app);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('This module\'s price is: $10000', "$module");

        $module = $factory->createModule(ModuleC::class, $app);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('My name is: David', "$module");

        $module = $factory->createModule(ModuleA::class, $app);

        $this->assertNull($module);
    }
}