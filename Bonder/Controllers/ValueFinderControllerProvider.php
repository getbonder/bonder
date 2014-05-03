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
   * @var \Bonder\Controller
   */
  private $default;
  
  public function __construct(\Bonder\Util\ValueFinder $valueFinder, 
    \Bonder\Controller $default) {
    $this->valueFinder = $valueFinder;
    $this->default = $default;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Controllers.ControllerProvider::getResult()
   */
  public function getResult($uri) {
    $result = $this->valueFinder->getFirstValue($uri);
    $controller = $this->default;
    $uriVariables = new \Bonder\Collections\Map();
    if (!is_null($result)) {
      $controller = $result->getValue();
      $uriVariables = $result->getVariables();
    }
    return new \Bonder\Controllers\ControllerProviderResult(
      $controller, $uriVariables);
  }
  
}