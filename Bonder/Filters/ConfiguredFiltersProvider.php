<?php

namespace Bonder\Filters;

/**
 * Decorates a filters provider, configuring the filter instances.
 * 
 * @author hbandura
 */
final class ConfiguredFiltersProvider 
  implements \Bonder\Filters\FiltersProvider {
  
  /**
   * @var \Bonder\Filters\FiltersProvider
   */
  private $wrappedProvider;
  
  /**
   * @var \Bonder\Util\Configurator
   */
  private $configurator;
  
  /**
   * Creates a new ConfiguredFiltersProvider with the arguments given.
   * 
   * @param \Bonder\Filters\FiltersProvider $wrappedProvider the wrapped
   * provider.
   * @param \Bonder\Util\Configurator $configurator the configurator.
   */
  public function __construct(
    \Bonder\Filters\FiltersProvider $wrappedProvider, 
    \Bonder\Util\Configurator $configurator) {
    $this->wrappedProvider = $wrappedProvider;
    $this->configurator = $configurator;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Filters.FiltersProvider::getFilters()
   */
  public function getFilters($uri) {
    $result = $this->wrappedProvider->getFilters($uri);
    $configurator = $this->configurator;
    array_walk($result, function($filter) use ($configurator) {
      $configurator->configure($filter);
    });
    return $result;
  }
  
}