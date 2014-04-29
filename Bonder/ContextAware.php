<?php

namespace Bonder;

/**
 * A Context aware object.
 * 
 * @author hbandura
 * @author burzak
 */
interface ContextAware {
  
  /**
   * Returns the Context.
   * 
   * @return \Bonder\Context the context.
   */
  public function getContext();
  
  /**
   * Sets the Context.
   * 
   * @param \Bonder\Context the context.
   */
  public function setContext(\Bonder\Context $context);
  
}