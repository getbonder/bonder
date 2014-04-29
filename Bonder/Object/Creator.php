<?php

namespace Bonder\Object;

/**
 * Creates objects.
 * 
 * @author hbandura
 */
final class Creator implements ObjectProvider {
  
  /**
   * Returns the object created.
   * 
   * @return mixed the object.
   */
  public function getObject($config) {
    if (!is_array($config)) {
      return $config;
    }
    if (count($config) != 2 && count($config) != 1) {
      throw new \Bonder\Exceptions\Exception("Config must have at most 2 arguments");
    }
    $class = reset($config);
    $params = array();
    if (count($config) > 1) {
      $params = next($config);
    }
    
    $r = new \ReflectionClass($class);
    return $r->newInstanceArgs($params);
  }
  
}