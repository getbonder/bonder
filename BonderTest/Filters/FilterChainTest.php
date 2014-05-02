<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
class FilterChainTest extends \PHPUnit_Framework_TestCase {
  
  public function testGetters() {
    $controller = $this->getMock("\Bonder\Controller");
    $filters = array(
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter")
    );
    $fc = new \Bonder\Filters\FilterChain($filters, $controller);
    $this->assertSame($controller, $fc->getController());
    $this->assertEquals($filters, $fc->getFilters());
  }
  
  public function testEmptyFilters() {
    $self = $this;
    $response = $this->getMock("\Bonder\Response");
    $originalRequest = $this->getMock("\Bonder\Request");
    $fc = new \Bonder\Filters\FilterChain(array(), 
      new \Bonder\Controllers\LambdaController(
        function(\Bonder\Request $request) use ($self, $originalRequest, $response) {
          $self->assertSame($originalRequest, $request);
          return $response;
        }
      )
    );
    $this->assertSame($response, $fc->call($originalRequest));
    // Again!
    $this->assertSame($response, $fc->call($originalRequest));
  }
  
  public function testCallAllFilters() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getMock("\Bonder\Request");
    $filters = array();
    $resultFilters = array();
    for ($i = 0; $i < 20; $i++) {
      $filters[] = $this->getFilterLink($resultFilters, $i);
    }
    $fc = new \Bonder\Filters\FilterChain($filters, 
      new \Bonder\Controllers\FixedResponseController($response));
    $controllerResponse = $fc->call($request);
    $this->assertSame($response, $controllerResponse);
    $this->assertEquals(range(0, 19), $resultFilters);
  }
  
  private function getFilterLink(&$resultFilters, $i) {
    return new \Bonder\Filters\LambdaFilter(
      function(\Bonder\Request $request, 
        \Bonder\Filters\NextFilterCaller $next) use (&$resultFilters, $i) {
        $resultFilters[] = $i;
        return $next->call($request);
      }
    );
  }
  
  private function getDropFilter(\Bonder\Response $response) {
    return new \Bonder\Filters\LambdaFilter(
      function(\Bonder\Request $request,
        \Bonder\Filters\NextFilterCaller $next) use ($response) {
        return $response;
      }
    );
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
    $fc = new \Bonder\Filters\FilterChain($filters,
      new \Bonder\Controllers\FixedResponseController($controllerResponse));
    $response = $fc->call($request);
    $this->assertSame($response, $dropFilterResponse);
    $this->assertEquals(range(0, 1), $arr);
  }
  
  
}