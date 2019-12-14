<?php
namespace KnotLib\Kernel\Responder;

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