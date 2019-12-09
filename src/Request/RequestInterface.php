<?php
namespace KnotLib\Kernel\Request;

interface RequestInterface
{
    /**
     * Return parameters
     *
     * @param string $params_type
     *
     * @return array
     */
    public function getParams(string $params_type) : array;
}