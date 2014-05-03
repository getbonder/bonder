<?php

namespace BonderTest\Controllers;

/**
 * @author hbandura
 */
final class DefaultControllersProviderTest 
  extends \PHPUnit_Framework_TestCase {
  
  private $defaultController;
  
  private $defaultUriVariables;
  
  private $wrappedProvider;
  
  private $cp;
  
  protected function setUp() {
    $this->defaultController = $this->getMock("\Bonder\Controller");
    $this->defaultUriVariables = new \Bonder\Collections\Map();
    $this->wrappedProvider = $this->getMock("\Bonder\Controllers\ControllerProvider");
    $this->cp = new \Bonder\Controllers\DefaultControllerProvider(
      $this->wrappedProvider,
      $this->defaultController,
      $this->defaultUriVariables
    );
  }
  
  public function testUsingDefault() {
    $uri = '/test/useme/uriahhh';    
    $this->wrappedProvider->expects($this->any())->method("getResult")
      ->with($uri)->willReturn(null);
    $result = $this->cp->getResult($uri);
    $this->assertSame($this->defaultController, $result->getController());
    $this->assertSame($this->defaultUriVariables, $result->getUriVariables());
  }
  
  public function testNotUsingDefault() {
    $uri = '/test/useme/uriahhh2';
    $controller = $this->getMock("\Bonder\Controller");
    $uriVariables = new \Bonder\Collections\Map();
    
    $result = new \Bonder\Controllers\ControllerProviderResult(
      $controller, $uriVariables);
    $this->wrappedProvider->expects($this->any())->method("getResult")
    ->with($uri)->willReturn($result);
    
    $result = $this->cp->getResult($uri);
    $this->assertSame($controller, $result->getController());
    $this->assertSame($uriVariables, $result->getUriVariables());
  }
  
}