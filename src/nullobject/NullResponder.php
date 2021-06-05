<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\responder\ResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class NullResponder implements ResponderInterface
{
    /**
     * Process response
     *
     * @param ResponseInterface $response
     *
     * @return void
     */
    public function respond(ResponseInterface $response)
    {
    }
}