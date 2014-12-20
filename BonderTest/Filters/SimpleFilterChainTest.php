<?php

namespace BonderTest\Filters;
use Bonder\Collections\Map;
use Bonder\Controllers\FixedResponseController;
use Bonder\Controllers\LambdaController;
use Bonder\Filters\LambdaFilter;
use Bonder\Filters\NextFilterCaller;
use Bonder\Filters\SimpleFilterChain;
use Bonder\Request;

/**
 * @author hbandura
 */
class SimpleFilterChainTest extends \PHPUnit_Framework_TestCase {
  
  public function testGetters() {
    $controller = $this->getMock("\Bonder\Controller");
    $filters = array(
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter")
    );
    $fc = new SimpleFilterChain($filters, $controller);
    $this->assertSame($controller, $fc->getController());
    $this->assertEquals($filters, $fc->getFilters());
  }
  
  public function testEmptyFilters() {
    $self = $this;
    $response = $this->getMock("\Bonder\Response");
    $originalRequest = $this->getMock("\Bonder\Request");
    $fc = new SimpleFilterChain(array(),
      new \Bonder\Controllers\LambdaController(
        function(Request $request) use ($self, $originalRequest, $response) {
          $self->assertSame($originalRequest, $request);
          return $response;
        }
      )
    );
    $this->assertSame($response, $fc->execute($originalRequest));
    // Again!
    $this->assertSame($response, $fc->execute($originalRequest));
  }
  
  public function testCallAllFilters() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getRequestMock(new Map());
    $filters = array();
    $resultFilters = array();
    for ($i = 0; $i < 20; $i++) {
      $filters[] = $this->getFilterLink($resultFilters, $i);
    }
    $fc = new SimpleFilterChain($filters,
      new FixedResponseController($response));
    $controllerResponse = $fc->execute($request);
    $this->assertSame($response, $controllerResponse);
    $this->assertEquals(range(0, 19), $resultFilters);
    $this->assertTrue($request->getFilterVariables()->isEmpty());
  }
  
  private function getFilterLink(&$resultFilters, $i) {
    return new LambdaFilter(
      function(Request $request,
        NextFilterCaller $next) use (&$resultFilters, $i) {
        $resultFilters[] = $i;
        return $next->call($request, array("var_$i" => "lol$i", "var2_$i" => "lol2$i"));
      }
    );
  }
  
  private function getDropFilter(\Bonder\Response $response) {
    return new LambdaFilter(
      function(Request $request,
        NextFilterCaller $next) use ($response) {
        return $response;
      }
    );
  }

  /** Returns the request mock to use in tests. */
  public function getRequestMock(Map $filterVariables) {
    $request = $this->getMock("\Bonder\Request");
    $request->expects($this->any())->method("getFilterVariables")->willReturn($filterVariables);
    return $request;
  }

  public function testFilterVariables() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getRequestMock(new Map());
    $filters = array();
    $resultFilters = array();
    for ($i = 0; $i < 20; $i++) {
      $filters["test_" . $i] = $this->getFilterLink($resultFilters, $i);
    }
    $vars = new Map();
    $fc = new SimpleFilterChain($filters,
        new LambdaController(function(Request $request) use ($vars, $response) {
          $vars->setAll($request->getFilterVariables());
          return $response;
        }));
    $fc->execute($request);
    for ($i = 0; $i < 20; $i++) {
      $this->assertEquals("lol$i", $vars->get("test_$i")->get("var_$i"));
      $this->assertEquals("lol2$i", $vars->get("test_$i")->get("var2_$i"));
    }
  }
  
  public function testDrop() {
    $controllerResponse = $this->getMock("\Bonder\Response");
    $dropFilterResponse = $this->getMock("\Bonder\Response");
    $this->assertNotSame($controllerResponse, $dropFilterResponse);
    $request = $this->getMock("\Bonder\Request");
    $arr = array();
    $filters = array(
      $this->getFilterLink($arr, 0),
      $this->getFilterLink($arr, 1),
      $this->getDropFilter($dropFilterResponse),
      $this->getFilterLink($arr, 2)
    );
    $fc = new SimpleFilterChain($filters,
      new FixedResponseController($controllerResponse));
    $response = $fc->execute($request);
    $this->assertSame($response, $dropFilterResponse);
    $this->assertEquals(range(0, 1), $arr);
  }
  
  
}