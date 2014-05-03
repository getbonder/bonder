<?php

namespace BonderTest\Collections;


/**
 * @author burzak
 * @author hbandura
 */
final class MapTest extends \PHPUnit_Framework_TestCase {
  
  public function testEmpty() {
    $map = new \Bonder\Collections\Map();
    $this->assertTrue($map->isEmpty());
    $this->assertEquals(0, $map->size());
    $map->set("something", "somethingval");
    $this->assertFalse($map->isEmpty());
    $this->assertEquals(1, $map->size());
  }
  
  public function testFromArray() {
    $array = array(
      '7' => 'seven',
      '19' => 'nineteen',
      '31' => 'thirty-one'
    );
    $map = \Bonder\Collections\Map::fromArray($array);
    $this->assertEquals(3, $map->size());
    $this->assertEquals('seven', $map->get('7'));
    $this->assertEquals('nineteen', $map->get('19'));
    $this->assertEquals('thirty-one', $map->get('31'));
    $this->assertEquals('default', $map->get('91', 'default'));
    $this->assertFalse($map->isLinkedTo($array));
  }
  
  public function testFromReference() {
    $array = array(
      '7' => 'seven',
      '19' => 'nineteen',
      '31' => 'thirty-one'
    );
    $map = \Bonder\Collections\Map::fromReference($array);
    $this->assertEquals(3, $map->size());
    unset($array['19']);
    $this->assertEquals(2, $map->size());
    $map->remove('31');
    $this->assertEquals(1, $map->size());
    $this->assertTrue($map->isLinkedTo($array));
  }
  
  public function testLinkTo() {
    $map = new \Bonder\Collections\Map();
    $map->set('3', 'three');
    $this->assertTrue($map->containsKey('3'));
    $array = array(
      '7' => 'seven',
      '19' => 'nineteen',
      '31' => 'thirty-one'
    );
    $map->linkTo($array);
    $this->assertFalse($map->containsKey('3'));
    $this->assertEquals(3, $map->size());
    $map->remove('31');
    $this->assertEquals(2, $map->size());
    unset($array['19']);
    $this->assertEquals(1, $map->size());
    $this->assertTrue($map->isLinkedTo($array));
  }
  
  public function testDefaultGetObject() {
    $map = new \Bonder\Collections\Map();
    $testObject = new \stdClass();
    $this->assertSame($testObject, $map->get("invalidKey", $testObject));
  }
  
  public function testDefaultGetPrimitive() {
    $map = new \Bonder\Collections\Map();
    $this->assertEquals(73939, $map->get("invalidKey", 73939));
    $this->assertEquals("mystring", $map->get("invalidKey_2", "mystring"));
  }
  
  public function testDefaultNull() {
    $map = new \Bonder\Collections\Map();
    $this->assertNull($map->get("invalidKey"));
  }
  
  public function testSimpleSet() {
    $map = new \Bonder\Collections\Map();
    $map->set("mykey", 79);
    $this->assertEquals(79, $map->get("mykey"));
    $this->assertEquals(79, $map->get("mykey", "default"));
  }
  
  public function testManySet() {
    $map = new \Bonder\Collections\Map();
    for ($i = 100; $i < 200; $i++) {
      $map->set("Key::$i", "Value::$i");
    }
    for ($i = 100; $i < 200; $i++) {
      $this->assertEquals("Value::$i", $map->get("Key::$i"));
    }
  }
  
  public function testRemove() {
    $map = new \Bonder\Collections\Map();
    $map->set("mykey", 79);
    $map->remove("mykey");
    $this->assertNull($map->get("mykey"));
    $this->assertTrue($map->isEmpty());
    $this->assertEquals(0, $map->size());
  }
  
  public function testContains() {
    $map = new \Bonder\Collections\Map();
    $map->set("mykey", 79);
    $map->set("mykey2", 80);
    $otherMap = new \Bonder\Collections\Map();
    $this->assertTrue($map->contains($otherMap));
    $otherMap->set("mykey", 79);
    $this->assertTrue($map->contains($otherMap));
    $otherMap->set("mykey3", 81);
    $this->assertFalse($map->contains($otherMap));
    $this->assertFalse($otherMap->contains($map));
    $map->remove("mykey2");
    $this->assertTrue($otherMap->contains($map));
    $map->set("mykey", "old_79");
    $this->assertFalse($otherMap->contains($map));
  }
}