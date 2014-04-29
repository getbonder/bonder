<?php

namespace BonderTest\Object;

/**
 * @author hbandura
 */
final class CreatorTest extends \PHPUnit_Framework_TestCase {
    
  public function testSimple() {
    $creator = new \Bonder\Object\Creator();
    $mock = $creator->getObject(array("\BonderTest\Object\CreatorTestMock"));
    $this->assertInstanceOf("\BonderTest\Object\CreatorTestMock", $mock);
    $this->assertNull($mock->arg1);
    $this->assertNull($mock->arg2);
  }
  
  public function testArgs() {
    $creator = new \Bonder\Object\Creator();
    $mock = $creator->getObject(array("\BonderTest\Object\CreatorTestMock", array('37', 39)));
    $this->assertInstanceOf("\BonderTest\Object\CreatorTestMock", $mock);
    $this->assertEquals(37, $mock->arg1);
    $this->assertEquals(39, $mock->arg2);
  }
  
  public function testObjectSame() {
    $creator = new \Bonder\Object\Creator();
    $obj = new \stdClass();
    $this->assertSame($obj, $creator->getObject($obj));
    $this->assertEquals(32, $creator->getObject(32));
  }
  
  public function testThrow() {
    $creator = new \Bonder\Object\Creator();
    try {
      $creator->getObject(array());
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
}

final class CreatorTestMock {
  
  public $arg1;
  
  public $arg2;
  
  public function __construct($arg1 = null, $arg2 = null) {
    $this->arg1 = $arg1;
    $this->arg2 = $arg2;
  }
  
}