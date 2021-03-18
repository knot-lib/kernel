<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Kernel;

use Throwable;

use PHPUnit\Framework\TestCase;

use KnotLib\Kernel\NullObject\NullFileSystem;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Test\Classes\Component\LoggerModule;
use KnotLib\Kernel\Test\Classes\Component\EventStreamModule;
use KnotLib\Kernel\Test\Classes\Component\ExHandlerModule;
use KnotLib\Kernel\Test\Classes\TestApplication;
use KnotLib\Kernel\Test\Classes\TestFileSystem;
use KnotLib\Kernel\Test\Classes\ModuleA;
use KnotLib\Kernel\Test\Classes\ModuleB;
use KnotLib\Kernel\Test\Classes\ModuleC;
use KnotLib\Kernel\Test\Classes\PackageX;
use KnotLib\Kernel\Test\Classes\PackageY;

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
    public function testUnrequireModule()
    {
        $app = new TestApplication(new TestFileSystem());

        $app->unrequireModule(ModuleA::class);

        $this->assertEquals([], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requireModule(ModuleA::class);
        $app->unrequireModule(ModuleA::class);

        $this->assertEquals([], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $app->unrequireModule(ModuleA::class);

        $this->assertEquals([ModuleB::class], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requireModule(ModuleA::class);
        $app->requireModule(ModuleB::class);
        $app->unrequireModule(ModuleB::class);

        $this->assertEquals([ModuleA::class], $app->getRequiredModules());
    }

    /**
     * @throws
     */
    public function testRequirePackage()
    {
        $app = new TestApplication(new TestFileSystem());

        $app->requirePackage(PackageX::class);

        $this->assertEquals([ModuleA::class, ModuleB::class,], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requirePackage(PackageY::class);

        $this->assertEquals([ModuleB::class, ModuleC::class,], $app->getRequiredModules());
    }

    /**
     * @throws
     */
    public function testUnrequirePackage()
    {
        $app = new TestApplication(new TestFileSystem());

        $app->requirePackage(PackageX::class);
        $app->unrequirePackage(PackageX::class);

        $this->assertEquals([], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requirePackage(PackageX::class);
        $app->requirePackage(PackageY::class);
        $app->unrequirePackage(PackageY::class);

        $this->assertEquals([ModuleA::class, ], $app->getRequiredModules());

        $app = new TestApplication(new TestFileSystem());

        $app->requireModule(ModuleC::class);
        $app->requirePackage(PackageX::class);
        $app->unrequirePackage(PackageX::class);

        $this->assertEquals([ModuleC::class], $app->getRequiredModules());
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