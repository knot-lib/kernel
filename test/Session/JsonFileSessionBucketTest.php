<?php
namespace KnotLib\Kernel\Test\Session;

use KnotLib\Kernel\Session\JsonFileSession;
use KnotLib\Kernel\Exception\JsonFileSessionException;
use KnotLib\Kernel\Session\JsonFileSessionBucket;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class JsonFileSessionBucketTest extends TestCase
{
    /**
     * @throws JsonFileSessionException
     */
    public function testHas()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path, []);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('color');

        $this->assertEquals([], $bucket->all());

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());
        $this->assertEquals(true, $bucket->has('Ada'));
        $this->assertEquals(false, $bucket->has('Timmy'));
        $this->assertEquals(true, $bucket->has('Ben'));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testGet()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());
        $this->assertEquals(11, $bucket->get('Ada'));
        $this->assertEquals(null, $bucket->get('Timmy'));
        $this->assertEquals(13, $bucket->get('Ben'));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testSet()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());

        $bucket->set('Ada', 12);
        $bucket->set('Camy', 7);
        $bucket->set('Timmy', 3);

        $this->assertEquals(['Ada'=>12,'Ben'=>13,'Camy'=>7,'Timmy'=>3], $bucket->all());
        $this->assertEquals(12, $bucket->get('Ada'));
        $this->assertEquals(3, $bucket->get('Timmy'));
        $this->assertEquals(13, $bucket->get('Ben'));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testUnset()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());

        $bucket->unset('Ada');
        $bucket->unset('Camy');
        $bucket->unset('Timmy');

        $this->assertEquals(['Ben'=>13], $bucket->all());
        $this->assertEquals(null, $bucket->get('Ada'));
        $this->assertEquals(null, $bucket->get('Timmy'));
        $this->assertEquals(13, $bucket->get('Ben'));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testClear()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());

        $bucket->clear();

        $this->assertEquals([], $bucket->all());
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testOffsetExists()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path, []);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('color');

        $this->assertEquals([], $bucket->all());

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());
        $this->assertEquals(true, isset($bucket['Ada']));
        $this->assertEquals(false, isset($bucket['Timmy']));
        $this->assertEquals(true, isset($bucket['Ben']));
    }
    /**
     * @throws JsonFileSessionException
     */
    public function testOffsetGet()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());
        $this->assertEquals(11, $bucket['Ada']);
        $this->assertEquals(null, $bucket['Timmy']);
        $this->assertEquals(13, $bucket['Ben']);
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testOffsetSet()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());

        $bucket['Ada'] = 12;
        $bucket['Camy'] = 7;
        $bucket['Timmy'] = 3;

        $this->assertEquals(['Ada'=>12,'Ben'=>13,'Camy'=>7,'Timmy'=>3], $bucket->all());
        $this->assertEquals(12, $bucket->get('Ada'));
        $this->assertEquals(3, $bucket->get('Timmy'));
        $this->assertEquals(13, $bucket->get('Ben'));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testOffsetUnset()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path,['Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada'=>11,'Ben'=>13,'Camy'=>6], $bucket->all());

        unset($bucket['Ada']);
        unset($bucket['Camy']);
        unset($bucket['Timmy']);

        $this->assertEquals(['Ben'=>13], $bucket->all());
        $this->assertEquals(null, $bucket->get('Ada'));
        $this->assertEquals(null, $bucket->get('Timmy'));
        $this->assertEquals(13, $bucket->get('Ben'));
    }

}