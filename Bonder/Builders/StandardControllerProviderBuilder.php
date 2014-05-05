<?php

namespace Bonder\Builders;

/**
 * Standard builder for controller providers.
 * 
 * @author hbandura
 */
final class StandardControllerProviderBuilder 
  implements \Bonder\Builders\ControllerProviderBuilder {
  
  /**
   * @var Array
   */
  private $controllers;
  
  /**
   * @var \Bonder\Context
   */
  private $context;
  
  /**
   * @var \Bonder\Controller
   */
  private $defaultController;
  
  /**
   * Creates a new StandardControllerProviderBuilder.
   */
  public function __construct() {
    $this->controllers = array();
    $this->context = new \Bonder\Contexts\MapContext(
      new \Bonder\Collections\Map());
    $this->defaultController = new \Bonder\Controllers\LambdaController(
      function() { throw new \Bonder\Exceptions\Exception(
        "No controller matched"); }
    );
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::setDefaultController()
   */
  public function setDefaultController(\Bonder\Controller $controller) {
    $this->defaultController = $controller;
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::getDefaultController()
   */
  public function getDefaultController() {
    return $this->defaultController;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::setContext()
   */
  public function setContext(\Bonder\Context $context) {
    $this->context = $context;
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::getContext()
   */
  public function getContext() {
    return $this->context;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::setControllers()
   */
  public function setControllers(Array $controllers) {
    $this->controllers = $controllers;
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::getControllers()
   */
  public function getControllers() {
    return $this->controllers;
  }
  
  /**
   * (non-PHPdoc)
   * @see Bonder\Builders.ControllerProviderBuilder::build()
   */
  public function build() {
    $matcher = new \Bonder\Util\RegexMatcher();
    $valueFinder = new \Bonder\Util\MatcherValueFinder(
      $matcher, $this->controllers);
    $valueFinderProvider = 
      new \Bonder\Controllers\ValueFinderControllerProvider($valueFinder);
    $defaultProvider = new \Bonder\Controllers\DefaultControllerProvider(
      $valueFinderProvider, 
      $this->defaultController, 
      new \Bonder\Collections\Map());
    $configurator = new \Bonder\Util\ContextConfigurator($this->context);
    return new \Bonder\Controllers\ConfiguredControllerProvider(
      $defaultProvider, 
      $configurator);
  }
}