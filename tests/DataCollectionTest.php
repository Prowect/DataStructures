<?php

namespace tests;

use Drips\DataStructures\DataCollection;
use PHPUnit_Framework_TestCase;

class DataCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testDC()
    {
        $key = "key";
        $value = "value";
        $result = array($key => $value);
        $collection = new DataCollection;
        $this->assertFalse($collection->has($key));
        $this->assertNull($collection->get($key));
        $collection->set($key, $value);
        $this->assertTrue($collection->has($key));
        $this->assertEquals($collection->getAll(), $result);
        $this->assertEquals($collection->get($key), $value);
        $this->assertFalse(isset($collection["töst"]));
        $collection["töst"] = "EINZ";
        $this->assertTrue(isset($collection["töst"]));
        $this->assertEquals($collection["töst"], "EINZ");
    }

    public function deleteDC()
    {
        $collection = new DataCollection;
        $this->assertFalse($collection->delete("key"));
        $this->assertFalse($collection->has("key"));
        $collection->set("key", 123);
        $this->assertTrue($collection->has("key"));
        $this->assertTrue($collection->delete("key"));
        $this->assertFalse($collection->has("key"));
    }

    public function testArrayAccess()
    {
        $collection = new DataCollection;
        $collection[] = "nulltes";
        $this->assertEquals(count($collection), 1);
        $this->assertFalse(isset($collection["töst"]));
        $collection["töst"] = "EINZ";
        $this->assertTrue(isset($collection["töst"]));
        $this->assertEquals($collection["töst"], "EINZ");
        unset($collection["töst"]);
        $this->assertFalse(isset($collection["töst"]));
    }
}
