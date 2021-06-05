<?php
declare(strict_types=1);

namespace knotlib\kernel\test;

use Throwable;

use knotlib\exception\KnotPhpException;
use knotlib\kernel\Bootstrap;
use PHPUnit\Framework\TestCase;
use knotlib\kernel\test\classes\BadApplication;
use knotlib\kernel\test\classes\TestApplication;
use knotlib\kernel\test\classes\ModuleA;
use knotlib\kernel\test\classes\ModuleB;
use knotlib\kernel\test\classes\PackageX;
use knotlib\kernel\test\classes\PackageY;

final class BootstrapTest extends TestCase
{
    public function testHandleException()
    {
        ob_start();
        (new Bootstrap())
            ->withExceptionHandler(function(Throwable $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class);

        $contents = ob_get_clean();

        $this->assertEquals('something is wrong.', $contents);
    }
    public function testBoot()
    {
        (new Bootstrap())
            ->withExceptionHandler(function(Throwable $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class, function($app){
                $this->assertInstanceOf(BadApplication::class, $app);
            });

        (new Bootstrap())
            ->withExceptionHandler(function(Throwable $e){
                echo $e->getMessage();
            })
            ->boot(TestApplication::class, function($app){
                $this->assertInstanceOf(TestApplication::class, $app);
            });
    }
    public function testPrepareModule()
    {
        ob_start();
        (new Bootstrap())
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->withModule(ModuleA::class)
            ->withModule(ModuleB::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->withModule(ModuleB::class)
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleB is installed.ModuleA is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->withModule(ModuleA::class)
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);
    }
    public function testPreparePackage()
    {
        ob_start();
        (new Bootstrap())
            ->withPakcage(PackageX::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->withPakcage(PackageY::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleB is installed.ModuleC is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->withPakcage(PackageX::class)
            ->withPakcage(PackageY::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.ModuleC is installed.', $contents);
    }
}