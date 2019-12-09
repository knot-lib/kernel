<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use Throwable;

use PHPUnit\Framework\TestCase;

use KnotLib\Kernel\NullObject\NullFileSystem;
use KnotLib\Kernel\Test\Component\ExHandlerModule;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Test\Component\LoggerModule;
use KnotLib\Kernel\Test\Component\EventStreamModule;

final class AbstractApplicationTest extends TestCase
{
    public function testApplication()
    {
        $app = new TestApplication(new TestFileSystem());

        $this->assertInstanceOf(ApplicationInterface::class, $app->application());
    }
    public function testFileSystem()
    {
        $app = new TestApplication();

        $this->assertInstanceOf(NullFileSystem::class, $app->filesystem());

        $app = new TestApplication(new TestFileSystem());

        $this->assertEquals(new TestFileSystem(), $app->filesystem());
    }
    public function testRequireModule()
    {
        $app = new TestApplication(new TestFileSystem());
        $this->assertSame([], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $this->assertSame([ModuleA::class], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $this->assertSame([ModuleA::class, ModuleB::class], $app->getRequiredModules());
    }
    public function testListRequireModules()
    {
        $app = new TestApplication(new TestFileSystem());
        $this->assertSame([], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $this->assertSame([ModuleA::class], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $this->assertSame([ModuleA::class, ModuleB::class], $app->getRequiredModules());
    }
    public function testGetInstalledModules()
    {
        $app = new TestApplication(new TestFileSystem());
        $this->assertSame([], $app->getInstalledModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ExHandlerModule::class);
        $app->requireModule(LoggerModule::class);
        $app->requireModule(EventStreamModule::class);
        try{
            $app->install();
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
        $expected = [
            ModuleA::class,
            ExHandlerModule::class,
            LoggerModule::class,
            EventStreamModule::class,
        ];
        $this->assertEquals($expected, $app->getInstalledModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $app->requireModule(ExHandlerModule::class);
        $app->requireModule(LoggerModule::class);
        $app->requireModule(EventStreamModule::class);
        try{
            $app->install();
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
        $expected = [
            ModuleA::class,
            ModuleB::class,
            ExHandlerModule::class,
            LoggerModule::class,
            EventStreamModule::class,
        ];
        $this->assertEquals($expected, $app->getInstalledModules());
    }
    public function testDependecyCache()
    {
        $app = new TestApplication(new TestFileSystem());
        $this->assertSame([], $app->getInstalledModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ExHandlerModule::class);
        $app->requireModule(EventStreamModule::class);
        $app->requireModule(LoggerModule::class);
        try{
            $app->install();
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
        $expected = [
            ModuleA::class,
            ExHandlerModule::class,
            EventStreamModule::class,
            LoggerModule::class,
        ];
        $this->assertEquals($expected, $app->getInstalledModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ExHandlerModule::class);
        $app->requireModule(EventStreamModule::class);
        $app->requireModule(LoggerModule::class);
        try{
            $app->install();
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
        $expected = [
            ModuleA::class,
            ExHandlerModule::class,
            EventStreamModule::class,
            LoggerModule::class,
        ];
        $this->assertEquals($expected, $app->getInstalledModules());

        $app = new TestApplication(new TestFileSystem());
        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $app->requireModule(ExHandlerModule::class);
        $app->requireModule(EventStreamModule::class);
        $app->requireModule(LoggerModule::class);
        try{
            $app->install();
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
        $expected = [
            ModuleA::class,
            ModuleB::class,
            ExHandlerModule::class,
            EventStreamModule::class,
            LoggerModule::class,
        ];
        $this->assertEquals($expected, $app->getInstalledModules());
    }
}