<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test;

use Throwable, Exception;

use KnotLib\Kernel\ExceptionHandler\CallableExceptionHandler;
use PHPUnit\Framework\TestCase;

final class CallableExceptionHandlerTest extends TestCase
{
    public function testHandleException()
    {
        $handler = new CallableExceptionHandler(function(Throwable $e){
            echo $e->getMessage();
        });

        ob_start();
        try{
            throw new Exception('Meow!');
        }
        catch(Throwable $e){
            $handler->handleException($e);
        }
        $contents = ob_get_clean();

        $this->assertEquals('Meow!', $contents);
    }
}