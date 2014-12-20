<?php

namespace Bonder\Filters;
use Bonder\Controller;
use Bonder\Filters\FiltersProvider;

/**
 * Decorates a filters provider, configuring the filter instances.
 * 
 * @author hbandura
 */
final class ConfiguredFiltersProvider 
  implements FiltersProvider {
  
  /**
   * @var FiltersProvider
   */
  private $wrappedProvider;
  
  /**
   * @var \Bonder\Util\Configurator
   */
  private $configurator;
  
  /**
   * Creates a new ConfiguredFiltersProvider with the arguments given.
   * 
   * @param FiltersProvider $wrappedProvider the wrapped
   * provider.
   * @param \Bonder\Util\Configurator $configurator the configurator.
   */
  public function __construct(
    FiltersProvider $wrappedProvider,
    \Bonder\Util\Configurator $configurator) {
    $this->wrappedProvider = $wrappedProvider;
    $this->configurator = $configurator;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Filters.FiltersProvider::getFilters()
   */
  public function getFilters($uri, Controller $controller) {
    $result = $this->wrappedProvider->getFilters($uri, $controller);
    $configurator = $this->configurator;
    array_walk($result, function($filter) use ($configurator) {
      $configurator->configure($filter);
    });
    return $result;
  }
  
}