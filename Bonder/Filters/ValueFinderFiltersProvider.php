<?php

namespace Bonder\Filters;
use Bonder\Controller;

/**
 * Filters provider implementation using a value finder.
 * 
 * @author hbandura
 */
final class ValueFinderFiltersProvider 
  implements \Bonder\Filters\FiltersProvider {
  
  /**
   * @var \Bonder\Util\ValueFinder
   */
  private $valueFinder;
  
  /**
   * Creates a new ValueFinderFiltersProvider with the value finder given.
   * 
   * @param \Bonder\Util\ValueFinder $valueFinder the value finder.
   */
  public function __construct(\Bonder\Util\ValueFinder $valueFinder) {
    $this->valueFinder = $valueFinder;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Filters.FiltersProvider::getFilters()
   */
  public function getFilters($uri, Controller $controller) {
    $results = $this->valueFinder->getAllValues($uri);
    $global = array_map(function(\Bonder\Util\ValueFinderResult $r) {
      return $r->getValue();
    }, $results);
    $cFilters = $controller->getFilters();
    $allFilters = array_merge($global, $cFilters);
    return $allFilters;
  }
  
}