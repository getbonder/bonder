<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
final class ValueFinderFiltersProviderTest extends \PHPUnit_Framework_TestCase {
  
  public function testEmpty() {
    $controller = $this->getController();
    $uri = '/omgomgomg/blahhh/aosentuhsaonethu';
    $valueFinder = $this->getMock("\Bonder\Util\ValueFinder");
    $valueFinder->expects($this->any())->method("getAllValues")
      ->with($uri)->willReturn(array());
    $fp = new \Bonder\Filters\ValueFinderFiltersProvider($valueFinder);
    $result = $fp->getFilters($uri, $controller);
    $this->assertTrue(is_array($result));
    $this->assertEmpty($result);
  }
  
  public function testGetFilters() {
    $uri = '/omgomgomg/blahhh/aosentuhsaonethu';
    $results = array(
      new \Bonder\Util\ValueFinderResult(
        'k', $uri, $this->getMock("\Bonder\Filter"), 
        new \Bonder\Collections\Map()),
      new \Bonder\Util\ValueFinderResult(
        'k', $uri, $this->getMock("\Bonder\Filter"),
        new \Bonder\Collections\Map()),
      new \Bonder\Util\ValueFinderResult(
        'k', $uri, $this->getMock("\Bonder\Filter"),
        new \Bonder\Collections\Map())
    );
    $valueFinder = $this->getMock("\Bonder\Util\ValueFinder");
    $valueFinder->expects($this->any())->method("getAllValues")
    ->with($uri)->willReturn($results);
    $fp = new \Bonder\Filters\ValueFinderFiltersProvider($valueFinder);
    $filters = $fp->getFilters($uri, $this->getController());
    $this->assertTrue(is_array($filters));
    for ($i = 0; $i < count($results); $i++) {
      $this->assertEquals($results[$i]->getValue(), $filters[$i]);
    }    
  }

  /**
   * @return \PHPUnit_Framework_MockObject_MockObject
   */
  private function getController() {
    $controller = $this->getMock("\Bonder\Controller");
    $controller->expects($this->any())->method("getFilters")->willReturn(array());
    return $controller;
  }
}