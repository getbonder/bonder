<?php

namespace Bonder\Filters;

/**
 * Filters provider implementation using a regex multiplexor.
 * 
 * @author hbandura
 */
final class RegexFiltersProvider implements \Bonder\Filters\FiltersProvider {
  
  /**
   * @var \Bonder\Util\RegexMultiplexor
   */
  private $multiplexor;
  
  /**
   * Creates a new RegexFiltersMultiplexor with the multiplexor given.
   * 
   * @param \Bonder\Util\RegexMultiplexor $multiplexor the multiplexor.
   */
  public function __construct(\Bonder\Util\RegexMultiplexor $multiplexor) {
    $this->multiplexor = $multiplexor;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Filters.FiltersProvider::getFilters()
   */
  public function getFilters($uri) {
    $matches = $this->multiplexor->getAllMatches($uri);
    return array_map(function(\Bonder\Util\RegexMultiplexorResult $r) {
      return $r->getValue();
    }, $matches);
  }
  
}