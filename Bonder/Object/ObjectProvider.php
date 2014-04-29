<?php

namespace Bonder\Object;

/**
 * Provides objects.
 * 
 * @author hbandura
 */
interface ObjectProvider {
  
  /**
   * Returns an object. 
   * 
   * @param mixed $config the config.
   * @return mixed the object.
   */
  public function getObject($config);
  
}