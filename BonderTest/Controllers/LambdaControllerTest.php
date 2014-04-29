<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class LambdaControllerTest extends \PHPUnit_Framework_TestCase {
  
  public function testThrow() {
    try {
      $c = new \Bonder\Controllers\LambdaController(null);
      $this->fail("Exception not thrown");
    } catch (\Bonder\Exceptions\Exception $e) {
      // success
    }
  }
  
  public function testSameRequest() {
    $self = $this;
    $originalRequest = $this->getMock("\Bonder\Request");
    $c = new \Bonder\Controllers\LambdaController(
      function(\Bonder\Request $request) use ($self, $originalRequest) {
        $self->assertSame($originalRequest, $request);
      }
    );
    $c->service($originalRequest);
    // Twice!
    $c->service($originalRequest);
  }
  
  public function testReturn() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getMock("\Bonder\Request");
    $c = new \Bonder\Controllers\LambdaController(
      function(\Bonder\Request $request) use ($response) {
        return $response;
      }
    );
    $this->assertSame($response, $c->service($request));
    // Again!
    $this->assertSame($response, $c->service($request));
  }
  
}