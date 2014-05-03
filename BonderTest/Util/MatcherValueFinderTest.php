<?php

namespace BonderTest\Util;

/**
 * @author burzak
 * @author hbandura 
 */
final class MatcherValueFinderTest extends \PHPUnit_Framework_TestCase {
  
  public function testSimple() {
    $values = array("match" => "Value");
    $matcher = $this->getMock("\Bonder\Util\Matcher");
    $variables = new \Bonder\Collections\Map();
    $rm = new \Bonder\Util\MatcherValueFinder($matcher, $values);
    $matcher->expects($this->any())->method("match")
      ->willReturnMap(array(
        array('match', 'test', false),
        array('match', 'match2', true)
    ));
    $matcher->expects($this->any())->method("getMatchVariables")
      ->with('match', 'match2')->willReturn($variables);
    $this->assertNull($rm->getFirstValue("test"));
    $result = $rm->getFirstValue("match2");
    $this->assertEquals("Value", $result->getValue());
    $this->assertEquals("match", $result->getKey());
    $this->assertEquals("match2", $result->getLiteral());
    $this->assertSame($variables, $result->getVariables());
  }
  
  public function testComplex() {
    $matcher = $this->getMock("\Bonder\Util\Matcher");
    $matcherResults = array(
      array('key1', 'lit1', true),
      array('key1', 'lit2', false),
      array('key1', 'lit3', false),
      
      array('key2', 'lit1', false),
      array('key2', 'lit2', true),
      array('key3', 'lit3', false),
      
      array('key3', 'lit1', false),
      array('key3', 'lit2', true),
      array('key3', 'lit3', false)
    );
    $key1lit1 = new \Bonder\Collections\Map();
    $key2lit2 = new \Bonder\Collections\Map();
    $key3lit2 = new \Bonder\Collections\Map();
    $variablesResults = array(
      array('key1', 'lit1', $key1lit1),
      array('key2', 'lit2', $key2lit2),
      array('key3', 'lit2', $key3lit2)
    );
    $rm = new \Bonder\Util\MatcherValueFinder($matcher, array(
      'key1' => 'value1',
      'key2' => 'value2',
      'key3' => 'value3'
    ));
    $matcher->expects($this->any())->method("match")
      ->willReturnMap($matcherResults);
    $matcher->expects($this->any())->method("getMatchVariables")
      ->willReturnMap($variablesResults);
    
    $this->assertNull($rm->getFirstValue('lit3'));
    $this->assertEmpty($rm->getAllValues('lit3'));
    
    $this->assertCount(1, $rm->getAllValues('lit1'));
    $result = $rm->getFirstValue('lit1');
    $this->assertEquals('value1', $result->getValue());
    $this->assertEquals('key1', $result->getKey());
    $this->assertEquals('lit1', $result->getLiteral());
    $this->assertSame($key1lit1, $result->getVariables());
    
    $all2 = $rm->getAllValues('lit2');
    $this->assertCount(2, $all2);
    $first2 = $rm->getFirstValue('lit2');
    $this->assertEquals($first2, reset($all2));
    $this->assertEquals('value2', $first2->getValue());
    $this->assertEquals('key2', $first2->getKey());
    $this->assertEquals('lit2', $first2->getLiteral());
    $this->assertEquals($key2lit2, $first2->getVariables());
  }
    
}