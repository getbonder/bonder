<?php

namespace Bonder\Filters;
use Bonder\Controller;

/**
 * Provides the filters to be used by a given uri and controller.
 * 
 * @author hbandura
 */
interface FiltersProvider {
  
  /**
   * Returns the filters for the given uri (global) and the controller.
   * 
   * @param string $uri the uri.
   * @return \Bonder\Filter[] the filters, as an array of alias => filter.
   */
  public function getFilters($uri, Controller $controller);

}