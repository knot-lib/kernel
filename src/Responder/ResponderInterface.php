<?php
namespace KnotLib\Kernel\Responder;

use KnotLib\Kernel\Response\ResponseInterface;

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