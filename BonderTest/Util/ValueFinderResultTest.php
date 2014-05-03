<?php

namespace BonderTest\Util;

/**
 * @author hbandura
 * @author burzak
 */
final class ValueFinderResultTest extends \PHPUnit_Framework_TestCase {
  
  private function doTest($key, $value, $literal, $variables) {
    $result = new \Bonder\Util\ValueFinderResult(
      $key,
      $literal,
      $value,
      $variables
    );
    $this->assertEquals($value, $result->getValue());
    $this->assertEquals($key, $result->getKey());
    $this->assertEquals($literal, $result->getLiteral());
    $this->assertSame($variables, $result->getVariables());
  }
  
  public function testCreateWithObject() {
    $this->doTest('key', new \stdClass(), 'literal', new \Bonder\Collections\Map());
  }
  
  public function testCreateWithString() {
    $this->doTest('key', 'value', 'literal', new \Bonder\Collections\Map());
  }
  
  public function testCreateWithArray() {
    $this->doTest('key', array('val1', 'val2', 'k3' => 'val3'), 'literal', 
      new \Bonder\Collections\Map());
  }
}