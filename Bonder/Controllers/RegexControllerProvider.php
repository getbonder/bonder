<?php

namespace Bonder\Controllers;

/**
 * ControllerProvider implementation using a regex multiplexor.
 * 
 * @author hbandura
 */
final class RegexControllerProvider 
  implements \Bonder\Controllers\ControllerProvider {
  
  /**
   * @var \Bonder\Util\RegexMultiplexor
   */
  private $multiplexor;
  
  /**
   * @var \Bonder\Controller
   */
  private $default;
  
  public function __construct(\Bonder\Util\RegexMultiplexor $multiplexor, 
    \Bonder\Controller $default) {
    $this->multiplexor = $multiplexor;
    $this->default = $default;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Controllers.ControllerProvider::getResult()
   */
  public function getResult($uri) {
    $result = $this->multiplexor->getFirstMatch($uri);
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