<?php

namespace Bonder\Controllers;

/**
 * Decorates a controller provider by configuring the controller object.
 * 
 * @author hbandura
 */
final class ConfiguredControllerProvider 
  implements \Bonder\Controllers\ControllerProvider {
  
  /**
   * @var \Bonder\Controllers\ControllerProvider
   */
  private $wrappedProvider;
  
  /**
   * @var \Bonder\Util\Configurator
   */
  private $configurator;
  
  /**
   * Creates a new ConfiguredControllerProvider with the arguments given.
   * 
   * @param \Bonder\Controllers\ControllerProvider $wrappedProvider the
   * wrapped provider.
   * @param \Bonder\Util\Configurator $configurator the configurator.
   */
  public function __construct(
    \Bonder\Controllers\ControllerProvider $wrappedProvider,
    \Bonder\Util\Configurator $configurator) {
    $this->wrappedProvider = $wrappedProvider;
    $this->configurator = $configurator;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Controllers.ControllerProvider::getResult()
   */
  public function getResult($uri) {
    $result = $this->wrappedProvider->getResult($uri);
    $this->configurator->configure($result->getController());
    return $result;
  }
  
}