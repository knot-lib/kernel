<?php
declare(strict_types=1);

namespace knotlib\kernel\test\classes\logger;

use PHPUnit\Framework\TestCase;

class LoggerTraitTest extends TestCase
{
    public function testEmergency()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->emergency('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[E]Tiger is not a cat.', $out);
    }

    public function testCritical()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->critical('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[C]Tiger is not a cat.', $out);
    }

    public function testAlert()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->alert('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[A]Tiger is not a cat.', $out);
    }

    public function testError()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->error('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[E]Tiger is not a cat.', $out);
    }

    public function testWarning()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->warning('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[W]Tiger is not a cat.', $out);
    }

    public function testNotice()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->notice('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[N]Tiger is not a cat.', $out);
    }

    public function testInfo()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->info('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[I]Tiger is not a cat.', $out);
    }

    public function testDebug()
    {
        $trait = new LoggerTraitClass();

        ob_start();
        $trait->debug('Tiger is not a cat.');
        $out = ob_get_clean();

        $this->assertStringStartsWith('[D]Tiger is not a cat.', $out);
    }

}