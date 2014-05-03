<?php

namespace Bonder\Util;

/**
 * Configures objects.
 *
 * @author hbandura
 */
interface Configurator {
  
  /**
   * Configures an object.
   *
   * @param mixed $object the object to configure.
   * @return mixed the same object.
   * @throws \Bonder\Exceptions\Exception if $object is not an object.
   */
  public function configure($object);
  
}