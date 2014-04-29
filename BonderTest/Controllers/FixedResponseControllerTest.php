<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class FixedResponseControllerTest extends \PHPUnit_Framework_TestCase {
  
  public function testReturn() {
    $response = $this->getMock("\Bonder\Response");
    $request = $this->getMock("\Bonder\Request");
    $c = new \Bonder\Controllers\FixedResponseController($response);
    $this->assertSame($response, $c->service($request));
    // Again!
    $this->assertSame($response, $c->service($request));
  }
  
}