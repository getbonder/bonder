<?php

namespace Bonder\Object;

/**
 * Configures objects.
 * 
 * @author hbandura
 */
final class Configurator implements \Bonder\Object\ObjectProvider {
  
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
   * Configurates an object.
   * 
   * @param mixed $object the object to configurate.
   * @return mixed the same object.
   * @throws \Bonder\Exceptions\Exception if $object is not an object.
   */
  public function getObject($object) {
    if (!is_object($object)) {
      throw new \Bonder\Exceptions\Exception('$object is not an object');
    }
    if ($object instanceof \Bonder\ContextAware) {
      $object->setContext($this->context);
    }
    return $object;
  }
  
}