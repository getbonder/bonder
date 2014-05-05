<?php

namespace Bonder\Builders;


/**
 * Builds filters providers.
 * 
 * @author hbandura
 */
interface FiltersProviderBuilder {
  
  /**
   * Sets the context.
   * 
   * @param \Bonder\Context $context the context.
   * @return \Bonder\Builders\FiltersProviderBuilder this.
   */
  public function setContext(\Bonder\Context $context);
  
  /**
   * Returns the context.
   * 
   * @return \Bonder\Context the context.
   */
  public function getContext();
  
  /**
   * Sets the filters to use, as a regex => filter array.
   * 
   * @param Array $filters the filters.
   * @return \Bonder\Builders\FiltersProviderBuilder this.
   */
  public function setFilters(Array $filters);
  
  /**
   * Returns the filters.
   * 
   * @return Array the filters.
   */
  public function getFilters();
  
  /**
   * Builds the filters provider.
   * 
   * @return \Bonder\Filters\FiltersProvider the filters provider.
   */
  public function build();
  
}