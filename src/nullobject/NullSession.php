<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\session\SessionInterface;
use knotlib\kernel\session\SessionBucketInterface;

final class NullSession implements SessionInterface
{
    /**
     * Clear all session variables
     *
     * @return void
     */
    public function clear()
    {
    }
    
    /**
     * Writes all session data and finishes session
     *
     * @return void
     */
    public function commit()
    {
    }
    
    /**
     * Destroy session entirely
     *
     * @return bool
     */
    public function destroy() : bool
    {
        return false;
    }
    
    /**
     * Returnes session bucket object
     *
     * @param string $name
     *
     * @return SessionBucketInterface
     */
    public function getBucket(string $name) : SessionBucketInterface
    {
        return new NullSessionBucket();
    }
}