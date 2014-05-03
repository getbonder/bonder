<?php

namespace Bonder\Util;

/**
 * Configures objects.
 * 
 * @author hbandura
 */
final class ContextConfigurator implements \Bonder\Util\Configurator {
  
  /**
   * 
   * @var \Bonder\Context
   */
  private $context;
  
  /**
   * Creates a new Configurator with the context given.
   * 
   * @param \Bonder\Context $context the context.
   */
  public function __construct(\Bonder\Context $context) {
    $this->context = $context;
  }
  
  /**
   * Returns the context.
   * 
   * @return \Bonder\Context the context.
   */
  public function getContext() {
    return $this->context;
  }
  
  /**
   * Configures an object.
   * 
   * @param mixed $object the object to configure.
   * @return mixed the same object.
   * @throws \Bonder\Exceptions\Exception if $object is not an object.
   */
  public function configure($object) {
    if (!is_object($object)) {
      throw new \Bonder\Exceptions\Exception('$object is not an object');
    }
    if ($object instanceof \Bonder\ContextAware) {
      $object->setContext($this->context);
    }
    return $object;
  }
  
}