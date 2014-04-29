<?php

namespace Bonder\Filters;

/**
 * Provides a filter chain from a URI given.
 * 
 * @author hbandura
 */
interface FilterChainProvider {
  
  /**
   * Returns the filter chain for the given URI.
   * 
   * @param string $uri the uri.
   * @return \Bonder\Filters\FilterChainProviderResult the filter chain result,
   * or null if no controller was found.
   */
  public function get($uri);
  
}