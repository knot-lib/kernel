<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use Throwable;

class JsonFileSessionException extends SessionException
{
    /**
     * construct
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct($message, int $code = 0, $prev = null){
        parent::__construct($message,$code, $prev);
    }
}