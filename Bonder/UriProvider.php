<?php

namespace Bonder;

/**
 * Returns the uri to process.
 * 
 * @author hbandura
 */
interface UriProvider {
  
  /**
   * Returns the uri to process.
   * 
   * @return string the uri.
   */
  public function getUri();
  
}