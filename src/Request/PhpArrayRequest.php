<?php
namespace KnotLib\Kernel\Request;

class PhpArrayRequest implements RequestInterface
{
    /** @var array */
    private $data;

    /**
     * PhpArrayRequest constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getParams(string $params_type) : array
    {
        switch($params_type)
        {
            case RequestParamsType::CONSOLE_ORDERED:
                return array_filter($this->data, function(/** @noinspection PhpUnusedParameterInspection */ $value, $key){
                    return is_int($key);
                }, ARRAY_FILTER_USE_BOTH);

            default:
                return array_filter($this->data, function(/** @noinspection PhpUnusedParameterInspection */ $value, $key){
                    return is_string($key);
                }, ARRAY_FILTER_USE_BOTH);
        }
    }

}