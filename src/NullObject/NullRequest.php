<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use Nyholm\Psr7\MessageTrait;
use Nyholm\Psr7\RequestTrait;
use Psr\Http\Message\RequestInterface;

final class NullRequest implements RequestInterface
{
    use MessageTrait;
    use RequestTrait;
}