<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class ValueFinderControllerProviderTest 
  extends \PHPUnit_Framework_TestCase {
  
  public function testNull() {
    $valueFinder = $this->getMock("\Bonder\Util\ValueFinder");
    $cp = new \Bonder\Controllers\ValueFinderControllerProvider($valueFinder);
    $this->assertNull($cp->getResult('/testNull'));
  }
  
  public function testFound() {
    $uri = '/testFoundMe/aonethusaoeu';
    $controller = $this->getMock("\Bonder\Controller");
    $uriVariables = new \Bonder\Collections\Map();
    $result = new \Bonder\Util\ValueFinderResult('key', $uri, $controller, 
      $uriVariables);
    $valueFinder = $this->getMock("\Bonder\Util\ValueFinder");
    $valueFinder->expects($this->any())->method("getFirstValue")
      ->with($uri)->willReturn($result);
    $cp = new \Bonder\Controllers\ValueFinderControllerProvider($valueFinder);
    $cpResult = $cp->getResult($uri);
    $this->assertSame($controller, $cpResult->getController());
    $this->assertSame($uriVariables, $cpResult->getUriVariables());
  }
}