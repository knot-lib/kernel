<?php
declare(strict_types=1);

namespace knotlib\kernel\test\Module;

use knotlib\kernel\module\CallableModuleFactory;
use knotlib\kernel\module\ModuleInterface;
use PHPUnit\Framework\TestCase;
use knotlib\kernel\test\classes\TestApplication;
use knotlib\kernel\test\classes\ModuleA;
use knotlib\kernel\test\classes\ModuleB;
use knotlib\kernel\test\classes\ModuleC;

final class CallableModuleFactoryTest extends TestCase
{
    public function testCreateModule()
    {
        $app = new TestApplication();
        $factory = new CallableModuleFactory(function(string $module_class){
            switch($module_class){
                case ModuleB::class:
                    return new ModuleB(20000);
                case ModuleC::class:
                    return new ModuleC('Smith');
            }
            return null;
        });

        $module = $factory->createModule(ModuleB::class, $app);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('This module\'s price is: $20000', "$module");

        $module = $factory->createModule(ModuleC::class, $app);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('My name is: Smith', "$module");

        $module = $factory->createModule(ModuleA::class, $app);

        $this->assertNull($module);
    }

}