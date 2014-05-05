<?php

namespace BonderTest\Builders;

/**
 * @author hbandura
 */
final class StandardFilterChainProviderBuilderTest 
  extends \PHPUnit_Framework_TestCase {
  
  public function testDefaults() {
    $builder = new \Bonder\Builders\StandardFilterChainProviderBuilder();
    $this->assertInstanceOf("\Bonder\Builders\ControllerProviderBuilder", 
      $builder->getControllerProviderBuilder());
    $this->assertInstanceOf("\Bonder\Builders\FiltersProviderBuilder",
      $builder->getFiltersProviderBuilder());
  }
  
  public function testForwardSets() {
    $builder = new \Bonder\Builders\StandardFilterChainProviderBuilder();
    $filtersBuilder = $this->getMock("\Bonder\Builders\FiltersProviderBuilder");
    $controllerBuilder = 
      $this->getMock("\Bonder\Builders\ControllerProviderBuilder");
    
    $context = $this->getMock("\Bonder\Context");
    $filters = array(
      'a' => $this->getMock("\Bonder\Filter"),
      'b' => $this->getMock("\Bonder\Filter")
    );
    $controllers = array(
      'a' => $this->getMock("\Bonder\Controller"),
      'b' => $this->getMock("\Bonder\Controller")
    );
    $defaultController = $this->getMock("\Bonder\Controller");
    
    $this->assertSame($builder,
      $builder->setControllerProviderBuilder($controllerBuilder));
    $this->assertSame($builder,
      $builder->setFiltersProviderBuilder($filtersBuilder));
    
    $controllerBuilder->expects($this->once())->method("setContext")
      ->with($context);
    $controllerBuilder->expects($this->once())->method("setDefaultController")
      ->with($defaultController);
    $controllerBuilder->expects($this->once())->method("setControllers")
      ->with($controllers);
    
    $filtersBuilder->expects($this->once())->method("setFilters")
      ->with($filters);
    $filtersBuilder->expects($this->once())->method("setContext")
      ->with($context);
    
    $this->assertSame($builder, $builder->setContext($context));
    $this->assertSame($builder, $builder->setFilters($filters));
    $this->assertSame($builder, $builder->setControllers($controllers));
    $this->assertSame($builder, 
      $builder->setDefaultController($defaultController));
  }
  
  public function testForwardBuild() {
    $builder = new \Bonder\Builders\StandardFilterChainProviderBuilder();
    $filtersBuilder = $this->getMock("\Bonder\Builders\FiltersProviderBuilder");
    $fp = $this->getMock("\Bonder\Filters\FiltersProvider");
    $filtersBuilder->expects($this->once())->method("build")
      ->willReturn($fp);
    $controllerBuilder =
      $this->getMock("\Bonder\Builders\ControllerProviderBuilder");
    $cp = $this->getMock("\Bonder\Controllers\ControllerProvider");
    $controllerBuilder->expects($this->once())->method("build")
      ->willReturn($cp);
    $builder->setFiltersProviderBuilder($filtersBuilder);
    $builder->setControllerProviderBuilder($controllerBuilder);
    $fcp = $builder->build();
    $this->assertEquals(new \Bonder\Filters\CrafterFilterChainProvider(
      $cp, $fp), $fcp);
  }
  
}