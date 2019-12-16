<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Kernel\Module\CallableModuleFactory;
use KnotLib\Kernel\Module\ModuleInterface;
use PHPUnit\Framework\TestCase;

final class CallableModuleFactoryTest extends TestCase
{
    public function testCreateModule()
    {
        $factory = new CallableModuleFactory(function(string $module_class){
            switch($module_class){
                case ModuleB::class:
                    return new ModuleB(20000);
                case ModuleC::class:
                    return new ModuleC('Smith');
            }
            return null;
        });

        $module = $factory->createModule(ModuleB::class);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('This module\'s price is: $20000', "$module");

        $module = $factory->createModule(ModuleC::class);

        $this->assertInstanceOf(ModuleInterface::class, $module);
        $this->assertEquals('My name is: Smith', "$module");

        $module = $factory->createModule(ModuleA::class);

        $this->assertNull($module);
    }

}