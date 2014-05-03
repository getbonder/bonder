<?php

namespace Bonder\Controllers;

/**
 * ControllerProvider implementation using a value finder.
 * 
 * @author hbandura
 */
final class ValueFinderControllerProvider 
  implements \Bonder\Controllers\ControllerProvider {
  
  /**
   * @var \Bonder\Util\ValueFinder
   */
  private $valueFinder;
  
  /**
   * Creates a new controller provider with the value finder given.
   * 
   * @param \Bonder\Util\ValueFinder $valueFinder the value finder.
   */
  public function __construct(\Bonder\Util\ValueFinder $valueFinder) {
    $this->valueFinder = $valueFinder;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Controllers.ControllerProvider::getResult()
   */
  public function getResult($uri) {
    $result = $this->valueFinder->getFirstValue($uri);
    if (is_null($result)) {
      return null;
    }
    return new \Bonder\Controllers\ControllerProviderResult(
      $result->getValue(), $result->getVariables());
  }
  
}