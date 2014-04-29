<?php

namespace Bonder\Object;

/**
 * Standard ObjectProvider factory. Returns object providers as a chain of
 * creator => configurator.
 * 
 * @author hbandura
 */
final class StandardObjectProviderFactory 
  implements \Bonder\Object\ObjectProvider {
  
  public function getObject($object) {
    if (!$object instanceof \Bonder\Context) {
      throw new \Bonder\Exceptions\Exception('$object is not a context');
    }
    return new \Bonder\Object\ProviderChain(array(
      new \Bonder\Object\Creator(),
      new \Bonder\Object\Configurator($object)
    ));
  }
  
}