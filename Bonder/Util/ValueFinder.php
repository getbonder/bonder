<?php

namespace Bonder\Util;

/**
 * Finds values from a literal string.
 * 
 * @author hbandura
 */
interface ValueFinder {
  
  /**
   * Returns the first value
   *
   * @param string $literal the literal string.
   * @return \Bonder\Util\ValueFinderResult the found result, or null if no 
   * value is found.
   */
  public function getFirstValue($literal);
  
  /**
   * Returns all values.
   *
   * @param string $literal the literal string.
   * @return \Bonder\Util\ValueFinderResult[] the found results.
   */
  public function getAllValues($literal);
  
}