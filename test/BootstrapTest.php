<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use KnotLib\Exception\KnotPhpException;
use KnotLib\Kernel\Bootstrap;
use PHPUnit\Framework\TestCase;

final class BootstrapTest extends TestCase
{
    public function testHandleException()
    {
        ob_start();
        (new Bootstrap())
            ->handleException(function(KnotPhpException $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class);

        $contents = ob_get_clean();

        $this->assertEquals('something is wrong.', $contents);
    }
    public function testBoot()
    {
        (new Bootstrap())
            ->handleException(function(KnotPhpException $e){
                echo $e->getMessage();
            })
            ->boot(BadApplication::class, function($app){
                $this->assertInstanceOf(BadApplication::class, $app);
            });

        (new Bootstrap())
            ->handleException(function(KnotPhpException $e){
                echo $e->getMessage();
            })
            ->boot(TestApplication::class, function($app){
                $this->assertInstanceOf(TestApplication::class, $app);
            });
    }
    public function testPrepare()
    {
        ob_start();
        (new Bootstrap())
            ->prepare(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->prepare(ModuleA::class)
            ->prepare(ModuleB::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.ModuleB is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->prepare(ModuleB::class)
            ->prepare(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleB is installed.ModuleA is installed.', $contents);

        ob_start();
        (new Bootstrap())
            ->prepare(ModuleA::class)
            ->prepare(ModuleA::class)
            ->boot(TestApplication::class);
        $contents = ob_get_clean();

        $this->assertEquals('ModuleA is installed.', $contents);
    }
}