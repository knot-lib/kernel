<?php
declare(strict_types=1);

namespace knotlib\kernel\responder;

use Psr\Http\Message\ResponseInterface;

interface ResponderInterface
{
    /**
     * Process response
     *
     * @param ResponseInterface $response
     *
     * @return void
     */
    public function respond(ResponseInterface $response);
}