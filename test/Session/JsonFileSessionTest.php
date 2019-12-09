<?php
namespace KnotLib\Kernel\Test\Session;

use KnotLib\Kernel\Exception\JsonFileSessionException;
use KnotLib\Kernel\Session\JsonFileSessionBucket;
use Exception;

use KnotLib\Kernel\Session\JsonFileSession;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class JsonFileSessionTest extends TestCase
{
    /**
     * @throws JsonFileSessionException
     */
    public function testConstruct()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        // construct by json file
        file_put_contents($path, "[]");
        $session = new JsonFileSession($path);

        $this->assertEquals([], $session->all());

        file_put_contents($path, "[1, 2, 3]");
        $session = new JsonFileSession($path);

        $this->assertEquals([1,2,3], $session->all());

        file_put_contents($path, '{"name": "Fred", "age": 31}');
        $session = new JsonFileSession($path);

        $this->assertEquals(["name"=>"Fred","age"=>31], $session->all());

        // construct with empty array
        $session = new JsonFileSession($path, []);

        $this->assertEquals([], $session->all());

        // construct with simple array
        $session = new JsonFileSession($path, [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $session->all());
    }

    public function testConstructError()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        // construct by brokwn json file
        file_put_contents($path, "[");

        try{
            new JsonFileSession($path);
            $this->fail();
        }
        catch(Exception $e){
            $this->assertEquals('json_decode failed([4]Syntax error) with file: vfs://root/session.file', $e->getMessage());
        }

        // construct by not existing json file
        try{
            new JsonFileSession(vfsStream::url('root/not_existing.file'));
            $this->fail();
        }
        catch(Exception $e){
            $expected = 'file_get_contents(vfs://root/not_existing.file) failed: file_get_contents(vfs://root/not_existing.file): failed to open stream: "org\bovigo\vfs\vfsStreamWrapper::stream_open" call failed';
            $this->assertEquals($expected, $e->getMessage());
        }
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testClear()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path, [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $session->all());

        $session->clear();

        $this->assertEquals([], $session->all());
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testCommit()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        // commit session with simple array data
        $session = new JsonFileSession($path, [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $session->all());

        try{
            $session->commit();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertSame("[1,2,3]", file_get_contents($path));

        // commit session with complicated array data
        $session = new JsonFileSession($path, ['name' => 'Fred', 'Children' => ['Ada','Ben','Camy']]);

        $this->assertEquals(['name' => 'Fred', 'Children' => ['Ada','Ben','Camy']], $session->all());

        try{
            $session->commit();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertSame('{"name":"Fred","Children":["Ada","Ben","Camy"]}', file_get_contents($path));

        // commit session with sigle bucket
        $session = new JsonFileSession($path,['name' => 'Fred', 'Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6]]);

        $children = $session->getBucket('Children');

        $children['Ada'] = 13;
        $children['Ben'] = 15;
        $children['Timmy'] = 5;

        try{
            $session->commit();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertSame('{"name":"Fred","Children":{"Ada":13,"Ben":15,"Camy":6,"Timmy":5}}', file_get_contents($path));

        // commit session with multiple buckets
        $session = new JsonFileSession($path,[
            'name' => 'Fred',
            'Children' => ['Ada'=>11,'Ben'=>13,'Camy'=>6],
            'Parents' => ['Roger'=>66,'Annie'=>64]
        ]);

        $children = $session->getBucket('Children');

        $children['Ada'] = 13;
        $children['Ben'] = 15;
        $children['Timmy'] = 5;

        $parents = $session->getBucket('Parents');

        $parents['Roger'] = 67;
        $parents['Annie'] = 65;

        try{
            $session->commit();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertSame('{"name":"Fred","Children":{"Ada":13,"Ben":15,"Camy":6,"Timmy":5},"Parents":{"Roger":67,"Annie":65}}', file_get_contents($path));
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testDestroy()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path, [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $session->all());

        try{
            $session->destroy();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertEquals([], $session->all());

        $session = new JsonFileSession($path, [1, 2, 3]);

        $this->assertEquals([1, 2, 3], $session->all());

        try{
            $session->commit();
            $session->destroy();
        }
        catch(Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertEquals(false, is_file($path));
        $this->assertEquals([], $session->all());
    }

    /**
     * @throws JsonFileSessionException
     */
    public function testGetBucket()
    {
        vfsStream::setup();
        $path = vfsStream::url('root/session.file');

        $session = new JsonFileSession($path, ['name' => 'Fred', 'Children' => ['Ada','Ben','Camy']]);

        /** @var JsonFileSessionBucket $bucket */
        $bucket = $session->getBucket('name');

        $this->assertEquals([], $bucket->all());

        $bucket = $session->getBucket('Children');

        $this->assertEquals(['Ada','Ben','Camy'], $bucket->all());
    }
}