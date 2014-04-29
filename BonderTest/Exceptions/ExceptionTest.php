<?php

namespace BonderTest\Exceptions;

/**
 * @author burzak
 * @author hbandura
 */
final class ExceptionTest extends \PHPUnit_Framework_TestCase {

  public function testThrowBonderException() {
    try {
      throw new \Bonder\Exceptions\Exception();
    } catch(\Bonder\Exceptions\Exception $e) {
      $this->assertInstanceOf("\Bonder\Exceptions\Exception", $e);
    }
  }
  
  public function testMessage() {
    $msg = "TestMessage39272937";
    $e = new \Bonder\Exceptions\Exception($msg);
    $this->assertEquals($msg, $e->getMessage());
  }
}