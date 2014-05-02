<?php

namespace Bonder\Controllers;

/**
 * Results from a \Bonder\Controllers\ControllerProvider.
 * 
 * @author hbandura
 */
final class ControllerProviderResult {
  
  /**
   * @var \Bonder\Controller
   */
  private $controller;
  
  /**
   * @var \Bonder\Collections\Map
   */
  private $uriVariables;
  
  /**
   * Creates a new ControllerProviderResult with the controller and uri
   * variables given.
   * 
   * @param \Bonder\Controller $controller the controller.
   * @param \Bonder\Collections\Map $uriVariables the uri variables.
   */
  public function __construct(
    \Bonder\Controller $controller, 
    \Bonder\Collections\Map $uriVariables) {
    $this->controller = $controller;
    $this->uriVariables = $uriVariables;
  }
  
  /**
   * Returns the controller.
   * 
   * @return \Bonder\Controller the controller.
   */
  public function getController() {
    return $this->controller;
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