<?php

namespace BonderTest\Http\Controllers;

/**
 * @author hbandura
 */
final class RedirectControllerTest extends \PHPUnit_Framework_TestCase {
  
  public function testGet() {
    $request = $this->getMock("\Bonder\Http\HttpRequest");
    $request->expects($this->any())->method("getMethod")->willReturn("GET");
    $this->doTestRequest($request);
  }
  
  private function doTestRequest(\Bonder\Http\HttpRequest $request) {
    $url = "https://sub.myurl.com?query=param&query2=param2";
    $controller = new \Bonder\Http\Controllers\RedirectController($url);
    $response = $controller->service($request);
    $this->assertInstanceOf("\Bonder\Http\Responses\RedirectResponse", $response);
    $this->assertEquals($url, $response->getRedirectUrl());
  }
  
  public function testPost() {
    $request = $this->getMock("\Bonder\Http\HttpRequest");
    $request->expects($this->any())->method("getMethod")->willReturn("POST");
    $this->doTestRequest($request);
  }
  
}