<?php
namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\Request\RequestInterface;

final class NullRequest implements RequestInterface
{
    /**
     * {@inheritDoc}
     */
    public function getParams(string $params_type) : array
    {
        return [];
    }
}