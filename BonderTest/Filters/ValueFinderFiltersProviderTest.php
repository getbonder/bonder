<?php

namespace BonderTest\Filters;
use Bonder\Collections\Map;
use Bonder\Filters\ValueFinderFiltersProvider;
use Bonder\Util\ValueFinderResult;

/**
 * @author hbandura
 */
final class ValueFinderFiltersProviderTest extends \PHPUnit_Framework_TestCase {
  
  public function testEmpty() {
    $controller = $this->getController(array());
    $uri = '/omgomgomg/blahhh/aosentuhsaonethu';
    $valueFinder = $this->getMock('\Bonder\Util\ValueFinder');
    $valueFinder->expects($this->any())->method("getAllValues")
      ->with($uri)->willReturn(array());
    $fp = new ValueFinderFiltersProvider($valueFinder);
    $result = $fp->getFilters($uri, $controller);
    $this->assertTrue(is_array($result));
    $this->assertEmpty($result);
  }
  
  public function testGetFilters() {
    $uri = '/omgomgomg/blahhh/aosentuhsaonethu';
    $globalFilter1 = $this->getMock('\Bonder\Filter');
    $globalFilter2 = $this->getMock('\Bonder\Filter');
    $globalFilter3 = $this->getMock('\Bonder\Filter');
    $results = array(
      new ValueFinderResult(
        'k', $uri, $globalFilter1,
        new Map()),
      new ValueFinderResult(
        'k', $uri, $globalFilter2,
        new Map()),
      new ValueFinderResult(
        'k', $uri, $globalFilter3,
        new Map())
    );
    $valueFinder = $this->getMock('\Bonder\Util\ValueFinder');
    $valueFinder->expects($this->any())->method("getAllValues")
    ->with($uri)->willReturn($results);
    $fp = new ValueFinderFiltersProvider($valueFinder);
    $cFilters = array(
      'alias1' => $this->getMock('\Bonder\Filter'),
      0 => $this->getMock('\Bonder\Filter'),
      'alias2' => $this->getMock('\Bonder\Filter')
    );
    $filters = $fp->getFilters($uri, $this->getController($cFilters));
    $this->assertTrue(is_array($filters));
    for ($i = 0; $i < count($results); $i++) {
      $this->assertEquals($results[$i]->getValue(), $filters[$i]);
    }
    $expectedFilters = array(
      $globalFilter1,
      $globalFilter2,
      $globalFilter3,
      'alias1' => $cFilters['alias1'],
      $cFilters[0],
      'alias2' => $cFilters['alias2']
    );
    $this->assertEquals($expectedFilters, $filters);
  }

  /**
   * @return \PHPUnit_Framework_MockObject_MockObject
   */
  private function getController(Array $filters) {
    $controller = $this->getMock('\Bonder\Controller');
    $controller->expects($this->any())->method("getFilters")->willReturn($filters);
    return $controller;
  }
}