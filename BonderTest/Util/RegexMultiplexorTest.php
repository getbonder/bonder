<?php

namespace BonderTest\Util;

/**
 * @author burzak
 * @author hbandura 
 */
final class RegexMultiplexorTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $values = array("match" => "Value");
    $rm = new \Bonder\Util\RegexMultiplexor($values);
    $this->assertNull($rm->getFirstMatch("test"));
    $this->assertEquals("Value", $rm->getFirstMatch("match")->getValue());
  }
  
  public function testMatch() {
    $values = array("match(?P<id>\w*)end" => 37);
    $rm = new \Bonder\Util\RegexMultiplexor($values);
    $result = $rm->getFirstMatch("matchthirtysevenend");
    $this->assertNotNull($result);
    $this->assertEquals(37, $result->getValue());
    $this->assertEquals("matchthirtysevenend", $result->getLiteral());
    $this->assertEquals("match(?P<id>\w*)end", $result->getRegex());
  }
  
  public function testFirst() {
    $values = array("dontmatchme" => 36, "match(?P<id>\w*)end" => 37, "match(?P<id2>\w*)end" => 38);
    $rm = new \Bonder\Util\RegexMultiplexor($values);
    $result = $rm->getFirstMatch("matchthirtysevenend");
    $this->assertNotNull($result);
    $this->assertEquals(37, $result->getValue());
    $this->assertEquals("matchthirtysevenend", $result->getLiteral());
    $this->assertEquals("match(?P<id>\w*)end", $result->getRegex());
  }
  
  public function testAll() {
    $values = array("dontmatchme" => 36, "match(?P<id>\w*)end" => 37, "match(?P<id2>\w*)end" => 38);
    $rm = new \Bonder\Util\RegexMultiplexor($values);
    $result = $rm->getAllMatches("matchthirtysevenend");
    $this->assertEquals(2, count($result));
    $this->assertEquals(37, $result[0]->getValue());
    $this->assertEquals("matchthirtysevenend", $result[0]->getLiteral());
    $this->assertEquals("match(?P<id>\w*)end", $result[0]->getRegex());
    $this->assertEquals(38, $result[1]->getValue());
    $this->assertEquals("matchthirtysevenend", $result[1]->getLiteral());
    $this->assertEquals("match(?P<id2>\w*)end", $result[1]->getRegex());
  }
  
}