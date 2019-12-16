<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use Throwable;

use KnotLib\Exception\KnotPhpException;
use KnotLib\Kernel\Knot;
use PHPUnit\Framework\TestCase;

final class KnotTest extends TestCase
{
    public function testHandleException()
    {
        ob_start();
        (new Knot())
            ->withExceptionHandler(function(KnotPhpException $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class);

        $contents = ob_get_clean();

        $this->assertEquals('something is wrong.', $contents);
    }
    public function testBoot()
    {
        (new Knot())
            ->withExceptionHandler(function(KnotPhpException $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class, function($app){
                $this->assertInstanceOf(BadApplication::class, $app);
            });

        (new Knot())
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
        (new Knot())
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);

        ob_start();
        (new Knot())
            ->withModule(ModuleA::class)
            ->withModule(ModuleB::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.', $contents);

        ob_start();
        (new Knot())
            ->withModule(ModuleB::class)
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleB is installed.ModuleA is installed.', $contents);

        ob_start();
        (new Knot())
            ->withModule(ModuleA::class)
            ->withModule(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);
    }
    public function testPreparePackage()
    {
        ob_start();
        (new Knot())
            ->withPakcage(PackageX::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.', $contents);

        ob_start();
        (new Knot())
            ->withPakcage(PackageY::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleB is installed.ModuleC is installed.', $contents);

        ob_start();
        (new Knot())
            ->withPakcage(PackageX::class)
            ->withPakcage(PackageY::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.ModuleC is installed.', $contents);
    }
}