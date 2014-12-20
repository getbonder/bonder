<?php

namespace Bonder\Filters;

/**
 * Provides the filters to be used by a given uri.
 * 
 * @author hbandura
 */
interface FiltersProvider extends PreFiltersAware {
  
  /**
   * Returns the filters for the given uri.
   * 
   * @param string $uri the uri.
   * @return \Bonder\Filter[] the filters.
   */
  public function getFilters($uri);

  public function getPreFilters();
  
}