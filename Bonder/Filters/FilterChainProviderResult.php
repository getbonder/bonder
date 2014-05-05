<?php

namespace Bonder\Filters;

/**
 * Result of a filter chain creation.
 * 
 * @author hbandura
 */
final class FilterChainProviderResult {
  
  /**
   * @var \Bonder\Filters\FilterChain
   */
  private $filterChain;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $uriVariables;
  
  /**
   * Creates a new FilterChainProviderResult.
   * 
   * @param \Bonder\Filters\FilterChain $filterChain the filter chain.
   * @param \Bonder\Collections\Map $uriVariables the uri variables.
   */
  public function __construct(\Bonder\Filters\FilterChain $filterChain,
          \Bonder\Collections\Map $uriVariables) {
    $this->filterChain = $filterChain;
    $this->uriVariables = $uriVariables;
  }
  
  /**
   * Returns the filter chain.
   * 
   * @return \Bonder\Filters\FilterChain the filter chain.
   */
  public function getFilterChain() {
    return $this->filterChain;
  }
  
  /**
   * Returns the uri variables.
   * 
   * @return \Bonder\Collections\Map the uri variables.
   */
  public function getUriVariables() {
    return $this->uriVariables;
  }
  
}