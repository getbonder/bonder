<?php

namespace Bonder\Filters;

/**
 * FilterChainProvider implementation which creates the filter chain crafting
 * them from results obtained from controller and filters providers.
 * 
 * @author hbandura
 */
final class CrafterFilterChainProvider implements 
  \Bonder\Filters\FilterChainProvider {
  
  /**
   * @var \Bonder\Controllers\ControllerProvider
   */
  private $controllerProvider;
  
  /**
   * @var \Bonder\Filters\FiltersProvider
   */
  private $filtersProvider;
  
  /**
   * Creates a new CrafterFilterChainProvider with the arguments given.
   * 
   * @param \Bonder\Controllers\ControllerProvider $controllerProvider the 
   * controller provider.
   * @param \Bonder\Filters\FiltersProvider $filtersProvider the filters
   * provider.
   */
  public function __construct(
    \Bonder\Controllers\ControllerProvider $controllerProvider,
    \Bonder\Filters\FiltersProvider $filtersProvider
    ) {
    $this->controllerProvider = $controllerProvider;
    $this->filtersProvider = $filtersProvider;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Filters.FilterChainProvider::get()
   */
  public function get($uri) {
    $controllerResult = $this->controllerProvider->getResult($uri);
    $filters = $this->filtersProvider->getFilters($uri, $controllerResult->getController());
    return new \Bonder\Filters\FilterChainProviderResult(
      new \Bonder\Filters\SimpleFilterChain($filters, $controllerResult->getController()), 
      $controllerResult->getUriVariables());
  }
  
}