<?php

namespace BonderTest\Filters;

/**
 * @author hbandura
 */
final class CrafterFilterChainProviderTest extends \PHPUnit_Framework_TestCase {
  
  public function testCreate() {
    $uri = "/mytst/uri{name}/{id}";
    $filters = array(
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
      $this->getMock("\Bonder\Filter"),
    );
    $uriVariables = new \Bonder\Collections\Map();
    $controller = $this->getMock("\Bonder\Controller");
    $cpr = new \Bonder\Controllers\ControllerProviderResult($controller, $uriVariables);
    
    $filtersProvider = $this->getMock("\Bonder\Filters\FiltersProvider");
    $controllerProvider = $this->getMock("\Bonder\Controllers\ControllerProvider");
    $filtersProvider->expects($this->once())->method("getFilters")
      ->with($uri)->willReturn($filters);
    $controllerProvider->expects($this->once())->method("getResult")
      ->with($uri)->willReturn($cpr);
    
    $fcp = new \Bonder\Filters\CrafterFilterChainProvider(
      $controllerProvider, $filtersProvider);
    $fcpr = $fcp->get($uri);
    $this->assertSame($uriVariables, $fcpr->getUriVariables());
    $this->assertEquals($filters, $fcpr->getFilterChain()->getFilters());
    $this->assertSame($controller, $fcpr->getFilterChain()->getController());
  }
  
}