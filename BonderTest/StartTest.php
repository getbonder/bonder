<?php

namespace BonderTest;

/**
 * @author burzak
 * @author hbandura
 */
final class StartTest extends \PHPUnit_Framework_TestCase {

  public function testStart() {
    $example = new \Bonder\Example();
    $this->assertEquals($example->hello(), "Testing coverrals");
  }

}