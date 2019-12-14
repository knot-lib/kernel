<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use Nyholm\Psr7\MessageTrait;
use Psr\Http\Message\ResponseInterface;

final class NullResponse implements ResponseInterface
{
    use MessageTrait;

    /** @var int */
    private $statusCode;

    public function getStatusCode()
    {
        return 400;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
    }

    public function getReasonPhrase()
    {
        return '';
    }
}