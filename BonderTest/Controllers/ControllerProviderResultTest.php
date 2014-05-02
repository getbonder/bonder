<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class ControllerProviderResultTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $controller = $this->getMock("\Bonder\Controller");
    $uriVariables = new \Bonder\Collections\Map();
    $cpr = new \Bonder\Controllers\ControllerProviderResult(
      $controller, $uriVariables);
    $this->assertSame($controller, $cpr->getController());
    $this->assertSame($uriVariables, $cpr->getUriVariables());
  }
  
}