<?php

namespace Bonder\Controllers;

/**
 * Provides controller and uri variables for URIs.
 * 
 * @author hbandura
 */
interface ControllerProvider {
  
  /**
   * Returns the \Bonder\Controllers\ControllerProviderResult for the given
   * uri.
   * 
   * @param string $uri the uri.
   * @return \Bonder\Controllers\ControllerProviderResult the result.
   */
  public function getResult($uri);
  
}