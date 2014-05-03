<?php

namespace BonderTest\Util;

/**
 * @author hbandura
 */
final class RegexMatcherTest extends \PHPUnit_Framework_TestCase {

  public function testSimpleMatch() {
    $expression = "match(?P<id>\w*)end";
    $values = array("match(?P<id>\w*)end" => 37);
    $rm = new \Bonder\Util\RegexMatcher();
    $this->assertTrue($rm->match($expression, "matchthirtysevenend"));
    $expVars = \Bonder\Collections\Map::fromArray(array('id' => 'thirtyseven'));
    $vars = $rm->getMatchVariables($expression, 'matchthirtysevenend');
    $this->assertTrue($vars->contains($expVars));
  }
  
  public function testUnmatch() {
    $rm = new \Bonder\Util\RegexMatcher();
    $this->assertFalse($rm->match('expr', 'lit'));
    try {
      $rm->getMatchVariables('expr', 'lit');
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testWrongRegex() {
    $rm = new \Bonder\Util\RegexMatcher();
    $this->assertFalse($rm->match('(?P<id', 'lol'));
    try {
      $rm->getMatchVariables('(?P<id', 'lol');
      $this->fail("Exception on wrong expr not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
}