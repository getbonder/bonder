<?php

namespace BonderTest;

/**
 * @author burzak
 * @author hbandura
 */
final class StartTest extends \PHPUnit_Framework_TestCase {

  public function testStart() {
    $this->assertEquals("Start", "Start");
  }

  public function testTravisHook() {
    $this->assertStringStartsWith("Travis", "Travis building now");
  }

  public function testFailingTest() {
    $this->assertEquals("It should", "break the build");
  }
}