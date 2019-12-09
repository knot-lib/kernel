<?php
namespace KnotLib\Kernel\Test\Session;

use KnotLib\Kernel\Request\PhpArrayRequest;
use KnotLib\Kernel\Request\RequestParamsType;
use PHPUnit\Framework\TestCase;

class PhpArrayRequestTest extends TestCase
{
    public function testGet()
    {
        $requst = new PhpArrayRequest([
        ]);

        $this->assertEquals([], $requst->getParams('data'));

        $requst = new PhpArrayRequest([
            "banana", 'foo' => 'bar', "kiwi", "orange", 'tiger' => 'cat'
        ]);

        $this->assertEquals(["banana", "kiwi", "orange"], $requst->getParams(RequestParamsType::CONSOLE_ORDERED));
        $this->assertEquals(['foo' => 'bar', 'tiger' => 'cat'], $requst->getParams(RequestParamsType::CONSOLE_NAMED));
    }
}