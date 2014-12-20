<?php

namespace BonderTest\Http;

/**
 * @author hbandura
 */
final class HttpControllerTest extends \PHPUnit_Framework_TestCase {

  public function testEmptyPreFilters() {
    $controller = $this->getMockForAbstractClass("\Bonder\Http\HttpController");
    $this->assertEmpty($controller->getPreFilters());
  }

  public function testContextGetter() {
    $controller = $this->getMockForAbstractClass("\Bonder\Http\HttpController");
    $context = $this->getMock("\Bonder\Context");
    $controller->setContext($context);
    $this->assertSame($context, $controller->getContext());
  }
  
  public function testThrowOnNonHttpRequest() {
    $controller = $this->getMockForAbstractClass("\Bonder\Http\HttpController");
    $request = $this->getMock("\Bonder\Request");
    try {
      $controller->service($request);
      $this->fail("Exception not thrown");
    } catch (\InvalidArgumentException $e) {
      // success
    }
  }
  
  public function testThrowOnGet() {
    $this->doTestThrowOnMethod("get");
  }
  
  public function testThrowOnPost() {
    $this->doTestThrowOnMethod("post");
  }
  
  public function testRedirectToGet() {
    $this->doTestMethod("get");
  }
  
  public function testRedirectToPost() {
    $this->doTestMethod("post");
  }
  
  private function doTestMethod($method) {
    $controller = $this->getMockForAbstractClass(
      "\Bonder\Http\HttpController",
      array(), 
      '', 
      true, 
      true, 
      true, 
      array($method)
    );
    $request = $this->getRequest($method);
    $response = $this->getMock("\Bonder\Http\HttpResponse");
    $controller->expects($this->any())->method($method)
      ->with($request)->willReturn($response);
    $this->assertSame($response, $controller->service($request));
  }
  
  private function doTestThrowOnMethod($method) {
    $controller = $this->getMockForAbstractClass("\Bonder\Http\HttpController");
    $request = $this->getRequest($method);
    try {
      $controller->service($request);
      $this->fail("Exception not thrown on $method");
    } catch (\Bonder\Exceptions\NotImplementedException $e) {
      // success
    }
    // try calling directly
    try {
      $controller->$method($request);
      $this->fail("Exception not thrown on $method");
    } catch (\Bonder\Exceptions\NotImplementedException $e) {
      // success
    }
  }
  
  private function getRequest($method) {
    $request = $this->getMock("\Bonder\Http\HttpRequest");
    $request->expects($this->any())->method("getMethod")
      ->willReturn($method);
    return $request;
  }
  
}