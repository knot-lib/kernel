<?php
namespace KnotLib\Kernel\Session;

use Stk2k\File\Exception\FileOutputException;
use Stk2k\File\File;
use KnotLib\Kernel\Exception\JsonFileSessionException;

class JsonFileSession implements SessionInterface
{
    /** @var array */
    private $data;

    /** @var string */
    private $filename;

    /**
     * JsonFileSession constructor.
     *
     * @param string $filename
     * @param array $data
     *
     * @throws JsonFileSessionException
     */
    public function __construct(string $filename, array $data = null)
    {
        $this->filename = $filename;
        if (is_array($data)){
            $this->data = $data;
        }
        else{
            $contents = @file_get_contents($filename);
            if (!$contents){
                $error = error_get_last()['message'];
                throw new JsonFileSessionException('file_get_contents(' . $filename . ') failed: ' . $error);
            }
            $this->data = json_decode($contents, true);
            if (!is_array($this->data)){
                $error = sprintf("[%d]%s", json_last_error(), json_last_error_msg());
                throw new JsonFileSessionException('json_decode failed(' . $error . ') with file: ' . $filename);
            }
        }
    }

    /**
     * Returns all elements
     *
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Clear all session variables
     *
     * @return void
     */
    public function clear()
    {
        $this->data = [];
    }

    /**
     * Writes all session data and finishes session
     *
     * @return void
     *
     * @throws
     */
    public function commit()
    {
        $data = [];
        foreach($this->data as $key => $value){
            if ($value instanceof JsonFileSessionBucket){
                $value = $value->all();
            }
            $data[$key] = $value;
        }

        $ret = @file_put_contents($this->filename, json_encode($data));
        if (!$ret){
            throw new FileOutputException(new File($this->filename), 'file_put_contents failed:' . json_encode(error_get_last()));
        }
    }

    /**
     * Destroy session entirely
     *
     * @return bool
     */
    public function destroy() : bool
    {
        if (is_file($this->filename)){
            @unlink($this->filename);
        }
        $this->data = [];
        return true;
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
        $bucket = $this->data[$name] ?? [];
        if ($bucket instanceof JsonFileSessionBucket){
            return $bucket;
        }
        if (!is_array($bucket)){
            // ignore the element and initialize bucket as an empty array.
            $bucket = [];
        }
        $this->data[$name] = new JsonFileSessionBucket($bucket);
        return $this->data[$name];
    }

}