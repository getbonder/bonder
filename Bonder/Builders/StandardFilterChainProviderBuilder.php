<?php

namespace Bonder\Builders;

/**
 * Builds the standard filter chain providers.
 * 
 * @author hbandura
 */
final class StandardFilterChainProviderBuilder {
    
  /**
   * @var \Bonder\Builders\ControllerProviderBuilder
   */
  private $controllerProviderBuilder;
  
  /**
   * @var \Bonder\Builders\FiltersProviderBuilder
   */
  private $filtersProviderBuilder;
  
  /**
   * Creates a new StandardFilterChainProviderBuilder.
   */
  public function __construct() {
    $this->controllerProviderBuilder = 
      new \Bonder\Builders\StandardControllerProviderBuilder();
    $this->filtersProviderBuilder = 
      new \Bonder\Builders\StandardFiltersProviderBuilder();
  }
  
  /**
   * Sets the controller provider builder to use.
   * 
   * @param \Bonder\Builders\ControllerProviderBuilder 
   *   $controllerProviderBuilder the controller provider builder.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setControllerProviderBuilder(
    \Bonder\Builders\ControllerProviderBuilder $controllerProviderBuilder) {
    $this->controllerProviderBuilder = $controllerProviderBuilder;
    return $this;
  }
  
  /**
   * Returns the controller provider builder.
   * 
   * @return \Bonder\Builders\ControllerProviderBuilder the controller provider
   * builder.
   */
  public function getControllerProviderBuilder() {
    return $this->controllerProviderBuilder;
  }
  
  /**
   * Sets the filters provider builder.
   * 
   * @param \Bonder\Builders\FiltersProviderBuilder $filtersProviderBuilder
   *  the filters provider builder.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setFiltersProviderBuilder(
    \Bonder\Builders\FiltersProviderBuilder $filtersProviderBuilder) {
    $this->filtersProviderBuilder = $filtersProviderBuilder;
    return $this;
  }
  
  /**
   * Returns the filters provider builder.
   * 
   * @return \Bonder\Builders\FiltersProviderBuilder the filters provider 
   * builder.
   */
  public function getFiltersProviderBuilder() {
    return $this->filtersProviderBuilder;
  }
  
  /**
   * Sets the default fallback controller.
   * 
   * @param \Bonder\Controller $controller the default controller.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setDefaultController(\Bonder\Controller $controller) {
    $this->controllerProviderBuilder->setDefaultController($controller);
    return $this;
  }
  
  /**
   * Sets the controllers, as a regex => controller array.
   * 
   * @param Array $controllers the controllers.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setControllers(Array $controllers) {
    $this->controllerProviderBuilder->setControllers($controllers);
    return $this;
  }
  
  /**
   * Sets the filters, as a regex => filters array.
   *
   * @param Array $filters the filters.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setFilters(Array $filters) {
    $this->filtersProviderBuilder->setFilters($filters);
    return $this;
  }
  
  /**
   * Sets the context.
   * 
   * @param \Bonder\Context $context the context.
   * @return \Bonder\Builders\StandardFilterChainProviderBuilder this.
   */
  public function setContext(\Bonder\Context $context) {
    $this->controllerProviderBuilder->setContext($context);
    $this->filtersProviderBuilder->setContext($context);
    return $this;
  }
  
  /**
   * Builds the filter chain provider.
   * 
   * @return \Bonder\Filters\FilterChainProvider the filter chain provider.
   */
  public function build() {
    return new \Bonder\Filters\CrafterFilterChainProvider(
      $this->controllerProviderBuilder->build(), 
      $this->filtersProviderBuilder->build());
  }
  
}