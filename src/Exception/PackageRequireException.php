<?php
namespace Calgamo\Module\Exception;

use Throwable;
use KnotLib\Kernel\Exception\KernelException;

class PackageRequireException extends KernelException
{
    /** @var string */
    private $package_class;

    /**
     * construct
     *
     * @param string $message
     * @param string $package_class
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $message, string $package_class, int $code = 0, Throwable $prev = null){
        parent::__construct($message, $code, $prev);

        $this->package_class = $package_class;
    }

    /**
     * @return string
     */
    public function getPackageClass() : string
    {
        return $this->package_class;
    }
}