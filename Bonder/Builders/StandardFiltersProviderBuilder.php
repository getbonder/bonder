<?php

namespace Bonder\Builders;

/**
 * Standard implementation for the filters provider builder.
 * 
 * @author hbandura
 */
final class StandardFiltersProviderBuilder 
  implements \Bonder\Builders\FiltersProviderBuilder {
  
  /**
   * @var \Bonder\Context
   */
  private $context;
  
  /**
   * @var Array
   */
  private $filters;
  
  /**
   * Creates a new standard filters provider builder.
   */
  public function __construct() {
    $this->context = new \Bonder\Contexts\MapContext(
      new \Bonder\Collections\Map());
    $this->filters = array();
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.FiltersProviderBuilder::setContext()
   */
  public function setContext(\Bonder\Context $context) {
    $this->context = $context;
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.FiltersProviderBuilder::getContext()
   */
  public function getContext() {
    return $this->context;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.FiltersProviderBuilder::setFilters()
   */
  public function setFilters(Array $filters) {
    $this->filters = $filters;
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.FiltersProviderBuilder::getFilters()
   */
  public function getFilters() {
    return $this->filters;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.FiltersProviderBuilder::build()
   */
  public function build() {
    $matcher = new \Bonder\Util\RegexMatcher();
    $valueFinder = new \Bonder\Util\MatcherValueFinder(
      $matcher, $this->filters);
    $valueFinderProvider = new \Bonder\Filters\ValueFinderFiltersProvider(
      $valueFinder);
    $configurator = new \Bonder\Util\ContextConfigurator($this->context);
    return new \Bonder\Filters\ConfiguredFiltersProvider(
      $valueFinderProvider, $configurator);
  }
  
}