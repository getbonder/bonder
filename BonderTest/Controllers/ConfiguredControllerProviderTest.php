<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class ConfiguredControllerProviderTest extends \PHPUnit_Framework_TestCase {
  
 public function testSimple() {
   $uri = '/osntaehu/aoeustnhao/oaeu';
   $controller = $this->getMock("\Bonder\Controller");
   $uriVariables = new \Bonder\Collections\Map();
   $result = new \Bonder\Controllers\ControllerProviderResult(
     $controller, 
     $uriVariables);
   $wrappedProvider = $this->getMock("\Bonder\Controllers\ControllerProvider");
   $configurator = $this->getMock("\Bonder\Util\Configurator");
   $configurator->expects($this->once())->method("configure")
     ->with($controller)->willReturn($controller);
   $wrappedProvider->expects($this->any())->method("getResult")
     ->with($uri)->willReturn($result);
   $cp = new \Bonder\Controllers\ConfiguredControllerProvider(
     $wrappedProvider, $configurator);
   $cpResult = $cp->getResult($uri);
   $this->assertSame($uriVariables, $cpResult->getUriVariables());
   $this->assertSame($controller, $cpResult->getController());
 }
  
}