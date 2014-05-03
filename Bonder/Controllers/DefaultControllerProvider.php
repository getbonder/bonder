<?php

namespace Bonder\Controllers;

/**
 * Decorates a controller provider with a default controller in case the
 * wrapped provider returns null.
 * 
 * @author hbandura
 */
final class DefaultControllerProvider 
  implements \Bonder\Controllers\ControllerProvider {
  
  /**
   * @var \Bonder\Controllers\ControllerProvider
   */
  private $wrappedProvider;
  
  /**
   * @var \Bonder\Controller
   */
  private $defaultController;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $defaultUriVariables;
  
  /**
   * Creates a new DefaultControllerProvider wrapping $wrappedProvider and
   * using the default controller $default.
   * 
   * @param \Bonder\Controllers\ControllerProvider $wrappedProvider the
   * wrapped provider.
   * @param \Bonder\Controller $defaultController the default controller.
   * @param \Bonder\Collections\Map $defaultUriVariables the default uri
   * variables.
   */
  public function __construct(
    \Bonder\Controllers\ControllerProvider $wrappedProvider,
    \Bonder\Controller $defaultController,
    \Bonder\Collections\Map $defaultUriVariables) {
    $this->wrappedProvider = $wrappedProvider;
    $this->defaultController = $defaultController;
    $this->defaultUriVariables = $defaultUriVariables;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Controllers.ControllerProvider::getResult()
   */
  public function getResult($uri) {
    $result = $this->wrappedProvider->getResult($uri);
    if (is_null($result)) {
      return new \Bonder\Controllers\ControllerProviderResult(
        $this->defaultController, $this->defaultUriVariables);
    }
    return $result;
  }
  
}