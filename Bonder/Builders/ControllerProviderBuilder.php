<?php

namespace Bonder\Builders;

/**
 * Builds a ControllerProvider.
 * 
 * @author hbandura
 */
interface ControllerProviderBuilder {
  
  /**
   * Sets the default controller.
   * 
   * @param \Bonder\Controller $controller the default controller.
   * @return \Bonder\Builders\ControllerProviderBuilder this.
   */
  public function setDefaultController(\Bonder\Controller $controller);
  
  /**
   * Returns the default controller.
   * 
   * @return \Bonder\Controller the default controller.
   */
  public function getDefaultController();
  
  /**
   * Sets the context.
   * 
   * @param \Bonder\Context $context the context.
   * @return \Bonder\Builders\ControllerProviderBuilder this.
   */
  public function setContext(\Bonder\Context $context);
  
  /**
   * Returns the context.
   * 
   * @return \Bonder\Context the context.
   */
  public function getContext();
  
  /**
   * Sets the controllers, as a regex => controller array.
   * 
   * @param Array $controllers the controllers.
   * @return \Bonder\Builders\ControllerProviderBuilder this.
   */
  public function setControllers(Array $controllers);
  
  /**
   * Returns the controllers.
   * 
   * @return Array the controllers.
   */
  public function getControllers();
  
  /**
   * Builds the controller provider.
   * 
   * @return \Bonder\Controllers\ControllerProvider the controller provider.
   */
  public function build();
  
}