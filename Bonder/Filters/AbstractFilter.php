<?php

namespace Bonder\Filters;

/**
 * Base filter class implementing the context aware methods of 
 * \Bonder\ContextAware
 * 
 * @author hbandura
 */
abstract class AbstractFilter implements \Bonder\Filters\ContextAwareFilter {
  
  /**
   * @var \Bonder\Context
   */
  private $context;
  
  /**
   * (non-PHPdoc)
   * @see Bonder.ContextAware::getContext()
   */
  public function getContext() {
    return $this->context;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder.ContextAware::setContext()
   */
  public function setContext(\Bonder\Context $context) {
    $this->context = $context;
  }
  
}