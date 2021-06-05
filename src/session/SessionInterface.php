<?php
declare(strict_types=1);

namespace knotlib\kernel\session;

interface SessionInterface
{
    /**
     * Clear all session variables
     *
     * @return void
     */
    public function clear();
    
    /**
     * Writes all session data and finishes session
     *
     * @return void
     */
    public function commit();
    
    /**
     * Destroy session entirely
     *
     * @return bool
     */
    public function destroy() : bool;
    
    /**
     * Returnes session bucket object
     *
     * @param string $name
     *
     * @return SessionBucketInterface
     */
    public function getBucket(string $name) : SessionBucketInterface;
}