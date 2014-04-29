<?php

namespace BonderTest\Util;

/**
 * @author hbandura
 * @author burzak
 */
final class RegexMultiplexorResultTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $regex = "(?P<test_var>\w*)";
    $literal = "test_value";
    $value = 37;
    $result = new \Bonder\Util\RegexMultiplexorResult($regex, $literal, $value);
    $this->assertEquals($value, $result->getValue());
    $this->assertEquals($regex, $result->getRegex());
    $this->assertEquals($literal, $result->getLiteral());
    $map = $result->getVariables();
    $this->assertEquals(3, $map->size());
    $this->assertEquals($literal, $map->get("test_var"));
  }
  
  public function testSimpleVariables() {
    $regex = "/someThing/(?P<id1>\w*)/(?P<id2>\w*)\.html";
    $literal = "/someThing/1993/2007.html";
    $value = new \stdClass();
    $result = new \Bonder\Util\RegexMultiplexorResult($regex, $literal, $value);
    $this->assertSame($value, $result->getValue());
    $this->assertEquals($regex, $result->getRegex());
    $this->assertEquals($literal, $result->getLiteral());
    $map = $result->getVariables();
    $this->assertEquals(5, $map->size());
    $this->assertEquals(1993, $map->get("id1"));
    $this->assertEquals(2007, $map->get("id2"));
  }
  
  public function testThrowWrongRegex() {
    $regex = "(?P<error";
    $literal = "lol";
    $value = new \stdClass();
    $result = new \Bonder\Util\RegexMultiplexorResult($regex, $literal, $value);
    try {
      $result->getVariables();
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testThrowUnmatchedRegex() {
    $regex = "lo2";
    $literal = "lol";
    $value = new \stdClass();
    $result = new \Bonder\Util\RegexMultiplexorResult($regex, $literal, $value);
    try {
      $result->getVariables();
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
}